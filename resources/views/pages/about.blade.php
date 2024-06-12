@extends("app")

@section('head_title', getcong_widgets('about_title') .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
 
<div class="sub-banner" style="background:url({{ URL::asset('upload/'.getcong('page_bg_image')) }}) no-repeat center top;">
    <div class="overlay">
      <div class="container">
        <h1>{{getcong_widgets('about_title')}}</h1>
      </div>
    </div>
  </div>
 
 <div class="what-we-do">
  <div class="container about_block">
  
    <div class="col-md-12">

        <!-- {!!getcong_widgets('about_desc')!!} -->
        <h2>About Us</h2>
        <p>At Dilicious Food, we're passionate about food and everything related to it. From creating delicious recipes to exploring different cuisines, we're always on the hunt for the next great meal. Our goal is to share our love of food with others and inspire them to try new things.</p>
        <p>Our team of experienced chefs and food enthusiasts are always experimenting with new flavors and techniques to create exciting dishes that are sure to delight your taste buds. Whether you're a seasoned foodie or just starting to explore the world of food, we've got something for everyone.</p>
        <h3>Our Mission</h3>
        <p>Our mission is to create a community of food lovers and inspire them to explore the world of food. We believe that food has the power to bring people together and create memorable experiences. Our goal is to share our passion for food with others and create a space where everyone can come together to celebrate their love of food.</p>
    </div>
   
  </div>
</div>
 

@endsection
