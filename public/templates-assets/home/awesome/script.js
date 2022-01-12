$(document).ready(function(){
  $('.extra-message-tab .nav-tabs li').click(function(){
    $(this).parent('ul').find('.active').removeClass('active');
    $(this).addClass('active');
  })
 
  
  // $('.slick-lastest-items').slick({
  //   infinite: true,
  //   slidesToShow: 4,
  //   slidesToScroll: 1
  // });
  

  $('.home-lastest-events-images-inner').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows:true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });



  $('.home-square-slider-images-inner').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows:false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });




  if($('.slick-lastest-items').length>0){
    $('.slick-lastest-items').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 4,
      autoplay: false,
      responsive: 
      [
        {
          breakpoint:992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint:570,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint:768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        }
      ]
    });
  }
 

  

  if($('.slick-featured-items').length>0){
    $('.slick-featured-items').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 4,
      autoplay: false,
      responsive: 
      [
        {
          breakpoint:992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint:570,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint:768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        }
      ]
    });
  }
  
  // $('.featured-latest-product-tab .nav-tabs li').click(function(){
  //   $(this).parent('ul').find('.active').removeClass('active');
  //   $(this).addClass('active');
    
  // })


  

    
    $('.featured-latest-product-tab .tab-content .tab-pane:not(:first)').hide();
    $('.featured-latest-product-tab .nav-tabs li a').on('click', function (e) {
      e.preventDefault();
      var tabLink = $(this);
      var target = $(this.hash);
      $('.featured-latest-product-tab .nav-tabs li').removeClass('active');
      $('.featured-latest-product-tab .tab-content .tab-pane:visible').fadeOut("200", function () {
        tabLink.children().addClass('active11');
        target.fadeIn("200", function() {
          $('.slick-lastest-items').slick("setPosition", 0);
        });
      });
      
      
    });
    
    // $('.js-presentation').slick("setPosition", 0);
    // $('.js-tabs-item:not(:first)').hide();
    // $('.js-tabs-link').on('click', function (e) {
    //   e.preventDefault();
    //   var tabLink = $(this);
    //   var target = $(this.hash);
    //   $('.js-tabs-text').removeClass('m-active');
    //   $('.js-tabs-item:visible').fadeOut("200", function () {
    //     tabLink.children().addClass('m-active');
    //     target.fadeIn("200", function() {
    //       $('.js-photo').slick("setPosition", 0);
    //     });
    //   });
      
      
    // });
    
    $('.slick-featured-items').slick("setPosition", 0);
    
  
  






  

  if($('.slick-recommended-items').length>0){
    $('.slick-recommended-items').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      responsive: 
      [
        {
          breakpoint:992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint:570,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint:768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        }
      ]
    });
  }
  
  if($('.brands-list-content').length>0){
    $('.brands-list-content').slick({
      infinite: true,
      slidesToShow: 5,
      slidesToScroll: 5,
      autoplay: true,
      responsive: 
      [
        {
          breakpoint:570,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint:768,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3
          }
        }
      ]
    });
  }
});