<!DOCTYPE html>
<html lang="en"> 

<head>

	<meta name="robots" content="" />
		
  <title>Thank You</title>
  
  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">    
  <link rel="shortcut icon" href="favicon.ico">  
  
  <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
  <link href="/templates/thankyou/style.css"  rel="stylesheet"/>
  <script defer src="https://kit.fontawesome.com/8b6502498a.js"></script>
  
  
  @if($landing->pixel_type=='code')
      {!!$landing->pixel!!}
  @endif

  @if($landing->pixel_type=='img')
    <img src="{{str_replace(' ', '', $landing->pixel)}}" height="1" width="1" style="display:none"/>
  @endif  
</head>
 <body>
  @if($pageData)
  <style> {!!$pageData->css_data !!} </style>
  {!! $pageData->html_data !!}
  @else
  <div class="content-wrapper">
    <div class="content">
        <div class="wrapper-1">
            <div class="wrapper-2">
                <h2 class="icon"><i class="fas fa-check"></i></h2>
                <h1>Thank you !</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                    ut labore et dolore magna aliqua.</p>
                <a class="go-home" href="/">
                    go back
                </a>
            </div>
        </div>
    </div>
</div>
@endif
@if($landing->pixel_type=='url')
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script>
      console.log('{{$response}}');
    //       var pixelUrl='';
    //   var params = @json($params);
    //   var newUrl = new URL('{{$landing->pixel}}')  
    //   Object.keys(params).forEach( index => {       
    
    //       newUrl.searchParams.append(index,params[index]);                        
    //   });  
    //   pixelUrl = newUrl 


    //  pageurl = pixelUrl.href
    //         var _token = "{{ csrf_token() }}";
    //         $.ajax({
    
    //         url:pageurl,
    //         headers: {
    //                 'Content-Type': 'application/x-www-form-urlencoded'
    //             },
    //         method:"POST",
    //         data:{},
    //         success:function(data)
    //         {
    //         }
    //         });
  </script>
  @endif  

 </body>