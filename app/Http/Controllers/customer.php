<?php
class ControllerApiCustomer extends Controller {

	public function UpdateCustomer($data) {
		$customer_id = $data['customer_id'];

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$data['customer_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "' WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function index() {
		die();
		$this->load->language('api/customer');
		$this->load->model('account/customer');
		// Delete past customer in case there is an error
		unset($this->session->data['customer']);

		$json = array();

		$row = 1;
		if (($handle = fopen("costumers_both_webshops.csv", "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		        $num = count($data);
		        $row++;
		        if(empty($data[0])){
		        	continue;
		        }

		        if($data[1]!="x"){
		        	continue;
		        }


		        $cdata = $data[0];

		        $cdata_arr = explode(',',$cdata);

		        $email = $cdata_arr[0];
		        $first_name = $cdata_arr[2];
		        $last_name = $cdata_arr[3];
		        $group_id = 2;
		        if($data[2]=="x"){ 
		        	$group_id = 3;
		        }

		        $fdata = array(
		        	'firstname' => $first_name,
		        	'lastname' => $last_name,
		        	'email' => $email,
		        	'password' => '3aAHnCo8cQj9',
		        	'customer_group_id' => $group_id,
		        	'telephone' => '',
		        	'newsletter' => 1,
		        	'company' => '',
		        	'address_1' => '',
		        	'address_2' => '',
		        	'city' => '',
		        	'postcode' => '',
		        	'country_id' => 57,
		        	'fax' => ''
		        );

		        echo $row."     ----    ".$email."  <br>";
		        if ($this->model_account_customer->getTotalCustomersByEmail($email)) {
		        	$cust = $this->model_account_customer->getCustomerByEmail($email);
		        	$cid = $cust['customer_id'];
		        	$fdata['customer_id'] = $cid;
		        	$this->UpdateCustomer($fdata);
					echo "Updated Account already exists ".$cid."  <br>";
				}
				else {
			        $customer_id = $this->model_account_customer->addCustomer($fdata);
			        echo "Added as customer : ".$customer_id."  <br>";
			    }
		        continue; 				
		    }
		    fclose($handle);
		}


	}
}
