<!DOCTYPE html>
<html lang="en"> 

<head>

	<meta name="robots" content="noindex, nofollow" />
		
    <title>DevBook - Bootstrap 4 Book/eBook Landing Page Template For Developers</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootstrap 4 Book/eBook Landing Page Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:700|Roboto:400,400i,700&amp;display=swap" rel="stylesheet">
    
    <!-- FontAwesome JS-->
    <script defer src="/templates/devbook/fontawesome.js"></script>

    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="/templates/devbook/style.css">

    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
	<script  src="https://unpkg.com/grapesjs"></script>
<style>.edit-btn{
  position: fixed;
        top: 15px;
        right: 5px;
        
        background: linear-gradient(to right, #827af3 0%, #b47af3 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#827af3", endColorstr="#b47af3", GradientType=1);
        padding: 8px 30px;
        border-radius: 0;
        font-family: 'Roboto';
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        font-weight: 500;
        color: #fff;
        border: none;
        border-radius: 45px;
        box-shadow: 0px 5px 15px rgb(0 0 0 / 33%);
        transition: all 0.3s ease 0s;
}
.edit-btn:hover {
  text-decoration: none;
    box-shadow: 0px 9px 14px rgb(165 122 243 / 42%);
    color: #fff;
    transform: translateY(-3px);
}</style>
</head> 
<body>
      @if( $landingData) 
         {!! $landingData->html_data !!}
      @else 
        <link id="theme-style" rel="stylesheet" href="https://demos.onepagelove.com/html/devbook/assets/css/theme.css">
        <header class="header">	    
            <div class="branding">
                <div class="container-fluid position-relative py-3">
                    <div class="logo-wrapper">
                        <div class="site-logo"><a class="navbar-brand" href="https://demos.onepagelove.com/html/devbook/index.html"><img class="logo-icon mr-2" src="https://demos.onepagelove.com/html/devbook/assets/images/site-logo.svg" alt="logo"><span class="logo-text">DevBook</span></a></div>    
                    </div><!--//docs-logo-wrapper-->
                
                </div><!--//container-->
            </div><!--//branding-->
        </header><!--//header-->
        <section class="hero-section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-7 pt-5 mb-5 align-self-center">
                        <div class="promo pr-md-3 pr-lg-5">
                            <h1 class="headline mb-3">
                                Free Book &amp; eBook <br>Landing Page Template   
                            </h1><!--//headline-->
                            <div class="subheadline mb-4">
                                A free Bootstrap 4 template for developers and programmers who want to self-publish books. Download now and start selling your book right away!
                                
                            </div><!--//subheading-->
                            
                            <div class="cta-holder">
                                <a class="btn btn-primary mr-lg-2" href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/devbook-free-bootstrap-4-book-ebook-landing-page-template-for-developers/">Buy for $20</a>
                                <a class="btn btn-secondary scrollto" href="#benefits-section">Learn More</a>
                                
                            </div><!--//cta-holder-->
                            
                            <div class="hero-quotes mt-5">
                                <div id="quotes-carousel" class="quotes-carousel carousel slide carousel-fade mb-5" data-ride="carousel" data-interval="8000">
                                    <ol class="carousel-indicators">
                                        {{-- <li data-target="#quotes-carousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#quotes-carousel" data-slide-to="1"></li>
                                        <li data-target="#quotes-carousel" data-slide-to="2"></li> --}}
                                    </ol>
                                
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <blockquote class="quote p-4 theme-bg-light">
                                                "Excellent Book! Add your book reviews here consectetur adipiscing elit. Aliquam euismod nunc porta urna facilisis tempor. Praesent mauris neque, viverra quis erat vitae, auctor imperdiet nisi."     
                                            </blockquote><!--//item-->
                                            <div class="source media flex-column flex-md-row align-items-center">
                                                <img class="source-profile mr-md-3" src="https://demos.onepagelove.com/html/devbook/assets/images/profiles/profile-1.png" alt="">
                                                <div class="source-info media-body text-center text-md-left">
                                                    <div class="source-name">James Doe</div>
                                                    <div class="soure-title">Co-Founder, Startup Week</div>
                                                </div>
                                            </div><!--//source-->
                                        </div><!--//carousel-item-->
                                       
                                    </div><!--//carousel-inner-->
                                </div><!--//quotes-carousel-->
                                
                            </div><!--//hero-quotes-->
                        </div><!--//promo-->
                    </div><!--col-->
                    <div class="col-12 col-md-5 mb-5 align-self-center">
                        <div class="book-cover-holder">
                            <img class="img-fluid book-cover" src="https://demos.onepagelove.com/html/devbook/assets/images/devbook-cover.png" alt="book cover">
                            <div class="book-badge d-inline-block shadow">
                                New<br>Release
                            </div>
                        </div><!--//book-cover-holder-->
                        <div class="text-center"><a class="theme-link scrollto" href="#reviews-section">See all book reviews</a></div>
                    </div><!--col-->
                </div><!--//row-->
            </div><!--//container-->
        </section><!--//hero-section-->
        <section id="benefits-section" class="benefits-section theme-bg-light-gradient py-5">
            <div class="container py-5">
                <h2 class="section-heading text-center mb-3">What Will You Get From This Book?</h2>
                <div class="section-intro single-col-max mx-auto text-center mb-5">Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer blandit consequat consequat. Orci varius natoque penatibus et magnis. </div>
                <div class="row text-center">
                    <div class="item col-12 col-md-6 col-lg-4">
                        <div class="item-inner p-3 p-lg-4">
                            <div class="item-header mb-3">
                                <div class="item-icon"><i class="fas fa-laptop-code"></i></div>
                                <h3 class="item-heading">Build Lorem Ipsum lobortis nec mauris habitant morbi</h3>
                            </div><!--//item-heading-->
                            <div class="item-desc">
                                List one of your book's benefits here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer blandit consequat consequat. 
                            </div><!--//item-desc-->
                        </div><!--//item-inner-->
                    </div><!--//item-->
                    <div class="item col-12 col-md-6 col-lg-4">
                        <div class="item-inner p-3 p-lg-4">
                            <div class="item-header mb-3">
                                <div class="item-icon"><i class="fab fa-js-square"></i></div>
                                <h3 class="item-heading">Learn from lorem ipsum dolor sit amet consectetur</h3>
                            </div><!--//item-heading-->
                            <div class="item-desc">
                                List one of your book's benefits here. Orci varius natoque penatibus et magnis dis parturient montes.
                            </div><!--//item-desc-->
                        </div><!--//item-inner-->
                    </div><!--//item-->
                    <div class="item col-12 col-md-6 col-lg-4">
                        <div class="item-inner p-3 p-lg-4">
                            <div class="item-header mb-3">
                                <div class="item-icon"><i class="fab fa-rocketchat"></i></div>
                                <h3 class="item-heading">Discover phasellus id egestas tellus maximus</h3>
                            </div><!--//item-heading-->
                            <div class="item-desc">
                                List one of your book's benefits here. Orci varius natoque penatibus et magnis dis parturient montes. 
                            </div><!--//item-desc-->
                        </div><!--//item-inner-->
                    </div><!--//item-->
                    <div class="item col-12 col-md-6 col-lg-4">
                        <div class="item-inner p-3 p-lg-4">
                            <div class="item-header mb-3">
                                <div class="item-icon"><i class="fab fa-angular"></i></div>
                                <h3 class="item-heading">Master aliquet augue ac ipsum lobortis interdum</h3>
                            </div><!--//item-heading-->
                            <div class="item-desc">
                                List one of your book's benefits here. Orci varius natoque penatibus et magnis dis parturient montes. 
                            </div><!--//item-desc-->
                        </div><!--//item-inner-->
                    </div><!--//item-->
                    <div class="item col-12 col-md-6 col-lg-4">
                        <div class="item-inner p-3 p-lg-4">
                            <div class="item-header mb-3">
                                <div class="item-icon"><i class="fas fa-code-branch"></i></div>
                                <h3 class="item-heading">Deploy elementum mauris tincidunt tempus sagittis</h3>
                            </div><!--//item-heading-->
                            <div class="item-desc">
                                List one of your book's benefits here. Orci varius natoque penatibus et magnis dis parturient montes. 
                            </div><!--//item-desc-->
                        </div><!--//item-inner-->
                    </div><!--//item-->
                    <div class="item col-12 col-md-6 col-lg-4">
                        <div class="item-inner p-3 p-lg-4">
                            <div class="item-header mb-3">
                                <div class="item-icon"><i class="fas fa-hand-holding-usd"></i></div>
                                <h3 class="item-heading">Become mattis est et mauris tempus non imperdiet</h3>
                            </div><!--//item-heading-->
                            <div class="item-desc">
                                List one of your book's benefits here. Orci varius natoque penatibus et magnis dis parturient montes. 
                            </div><!--//item-desc-->
                        </div><!--//item-inner-->
                    </div><!--//item-->
                </div><!--//row-->
            </div><!--//container-->
        </section><!--//benefits-section-->
        
        <section class="content-section">
            <div class="container">
                <div class="single-col-max mx-auto">
                <h2 class="section-heading text-center mb-5">What's Included</h2>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="figure-holder mb-5">
                                <img class="img-fluid" src="https://demos.onepagelove.com/html/devbook/assets/images/devbook-devices.png" alt="image">
                            </div><!--//figure-holder-->
                        </div><!--//col-->
                        <div class="col-12 col-md-6 mb-5">
                            <div class="key-points mb-4 text-center">
                                <ul class="key-points-list list-unstyled mb-4 mx-auto d-inline-block text-left">
                                    <li><i class="fas fa-check-circle mr-2"></i>List your book's content here.</li>
                                    <li><i class="fas fa-check-circle mr-2"></i>PDF fermentum tincidunt erat.</li>
                                    <li><i class="fas fa-check-circle mr-2"></i>EPUB curabitur fermentum.</li>
                                    <li><i class="fas fa-check-circle mr-2"></i>Lorem ipsum dolor sit amet.</li>
                                    <li><i class="fas fa-check-circle mr-2"></i>Praesent molestie odio risus. </li>
                                    <li><i class="fas fa-check-circle mr-2"></i>Kindle curabitur fermentum.</li>
                                    <li><i class="fas fa-check-circle mr-2"></i>Kindle curabitur fermentum.</li>
                                    <li><i class="fas fa-check-circle mr-2"></i>Kindle curabitur fermentum.</li>
                                </ul>
                                <div class="text-center"><a class="btn btn-primary" href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/devbook-free-bootstrap-4-book-ebook-landing-page-template-for-developers/">I want this book</a></div>
                            </div><!--//key-points-->
                            
                        </div><!--//col-12-->   
                    </div><!--//row-->
                </div><!--//single-col-max-->
            </div><!--//container-->
        </section><!--//content-section-->
        
        <section class="audience-section py-5">
            <div class="container">
                <h2 class="section-heading text-center mb-4">Who This Book Is For</h2>
                <div class="section-intro single-col-max mx-auto text-center mb-5">
                    List your target readers in this section and back up with reviews. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales sit amet neque sit amet molestie. Vivamus hendrerit nisi condimentum erat tempus, vitae accumsan odio euismod.
                </div><!--//section-intro-->
                <div class="audience mx-auto">
                    <div class="item media">
                        <div class="item-icon mr-3"><i class="fas fa-user-check"></i></div>
                        <div class="media-body">
                            <h4 class="item-title">Software Developers</h4>
                            <div class="item-desc">Learn lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales sit amet neque sit amet molestie.</div>
                        </div><!--//media-body-->
                    </div><!--//item-->
                    <div class="item media">
                        <div class="item-icon mr-3"><i class="fas fa-user-check"></i></div>
                        <div class="media-body">
                            <h4 class="item-title">App Developers</h4>
                            <div class="item-desc">Learn lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales sit amet neque sit amet molestie.</div>
                        </div><!--//media-body-->
                    </div><!--//item-->
                    <div class="item media">
                        <div class="item-icon mr-3"><i class="fas fa-user-check"></i></div>
                        <div class="media-body">
                            <h4 class="item-title">Web Developers</h4>
                            <div class="item-desc">Learn lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales sit amet neque sit amet molestie.</div>
                        </div><!--//media-body-->
                    </div><!--//item-->
                    <div class="item media">
                        <div class="item-icon mr-3"><i class="fas fa-user-check"></i></div>
                        <div class="media-body">
                            <h4 class="item-title">Product Designers</h4>
                            <div class="item-desc">Learn lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales sit amet neque sit amet molestie.</div>
                        </div><!--//media-body-->
                    </div><!--//item-->
                </div><!--//audience-->
            </div><!--//container-->
        </section><!--//audience-section-->
        
        <section class="form-section">
            <div class="container">
                <div class="lead-form-wrapper single-col-max mx-auto theme-bg-light rounded p-5">
                    <h2 class="form-heading text-center">Get A Free Preview</h2>
                    <div class="form-intro text-center mb-3">Sign up to get a free preview of the book. <br>You can offer visitors free book previews to generate leads.</div>
                    <div class="form-wrapper">
                        <form class="form-inline justify-content-center flex-wrap">
                            <div class="form-group mr-md-2 mb-3 mb-md-0">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" class="form-control " id="email" placeholder="Your Email">
                            </div>
                            <button type="submit" class="btn btn-primary btn-submit mb-3 mb-md-0">Send</button>
                        </form>
                    </div><!--//form-wrapper-->
                </div><!--//lead-form-wrapper-->
            </div><!--//container-->
        </section><!--//form-section-->
        
        <section id="reviews-section" class="reviews-section py-5">
            <div class="container">
                <h2 class="section-heading text-center">Book Reviews</h2>
                <div class="section-intro text-center single-col-max mx-auto mb-5">See what our readers are saying. </div>
                <div class="row justify-content-center">
                    <div class="item col-12 col-lg-4 p-3 mb-4">
                        <div class="item-inner theme-bg-light rounded p-4">
                            
                            <blockquote class="quote">
                                "Excellent Book! Add your book review here consectetur adipiscing elit. Aliquam euismod nunc porta urna facilisis tempor. "     
                            </blockquote><!--//item-->
                            <div class="source media flex-column flex-md-row align-items-center">
                                <img class="source-profile mr-md-3" src="https://demos.onepagelove.com/html/devbook/assets/images/profiles/profile-1.png" alt="">
                                <div class="source-info media-body text-center text-md-left">
                                    <div class="source-name">James Doe</div>
                                    <div class="soure-title">Co-Founder, Startup Week</div>
                                </div>
                            </div><!--//source-->
                            <div class="icon-holder"><i class="fas fa-quote-right"></i></div>
                        </div><!--//inner-->
                    </div><!--//item-->
                    <div class="item col-12 col-lg-4 p-3 mb-4">
                        <div class="item-inner theme-bg-light rounded p-4">
                            <blockquote class="quote">
                                "Great Book! Add your book review here consectetur adipiscing elit. Aliquam euismod nunc porta urna facilisis tempor. Praesent mauris neque."     
                            </blockquote><!--//item-->
                            <div class="source media flex-column flex-md-row align-items-center">
                                <img class="source-profile mr-md-3" src="https://demos.onepagelove.com/html/devbook/assets/images/profiles/profile-2.png" alt="">
                                <div class="source-info media-body text-center text-md-left">
                                    <div class="source-name">Jean Doe</div>
                                    <div class="soure-title">Co-Founder, Company Tristique</div>
                                </div>
                            </div><!--//source-->
                            <div class="icon-holder"><i class="fas fa-quote-right"></i></div>
                        </div><!--//inner-->
                    </div><!--//item-->
                    <div class="item col-12 col-lg-4 p-3 mb-4">
                        <div class="item-inner theme-bg-light rounded p-4">
                            <blockquote class="quote">
                                "Excellent Book! Add your book review here consectetur adipiscing elit. Pellentesque ac leo turpis. Phasellus imperdiet id ligula tempor imperdiet."     
                            </blockquote><!--//item-->
                            <div class="source media flex-column flex-md-row align-items-center">
                                <img class="source-profile mr-md-3" src="https://demos.onepagelove.com/html/devbook/assets/images/profiles/profile-3.png" alt="">
                                <div class="source-info media-body text-center text-md-left">
                                    <div class="source-name">Tom Doe</div>
                                    <div class="soure-title">Product Designer, Company Lorem</div>
                                </div>
                            </div><!--//source-->
                            <div class="icon-holder"><i class="fas fa-quote-right"></i></div>
                        </div><!--//inner-->
                    </div><!--//item-->
                    <div class="item col-12 col-lg-4 p-3 mb-4">
                        <div class="item-inner theme-bg-light rounded p-4">
                            <blockquote class="quote">
                                "Another book review here consectetur adipiscing elit. Pellentesque ac leo turpis. Phasellus imperdiet id ligula tempor imperdiet."     
                            </blockquote><!--//item-->
                            <div class="source media flex-column flex-md-row align-items-center">
                                <img class="source-profile mr-md-3" src="https://demos.onepagelove.com/html/devbook/assets/images/profiles/profile-4.png" alt="">
                                <div class="source-info media-body text-center text-md-left">
                                    <div class="source-name">Alice Doe</div>
                                    <div class="soure-title">App Developer, Company Ipsum</div>
                                </div>
                            </div><!--//source-->
                            <div class="icon-holder"><i class="fas fa-quote-right"></i></div>
                        </div><!--//inner-->
                    </div><!--//item-->
                    <div class="item col-12 col-lg-4 p-3 mb-4">
                        <div class="item-inner theme-bg-light rounded p-4">
                            <blockquote class="quote">
                                "Another book review here consectetur adipiscing elit. Pellentesque ac leo turpis. Phasellus imperdiet id ligula tempor imperdiet."     
                            </blockquote><!--//item-->
                            <div class="source media flex-column flex-md-row align-items-center">
                                <img class="source-profile mr-md-3" src="https://demos.onepagelove.com/html/devbook/assets/images/profiles/profile-5.png" alt="">
                                <div class="source-info media-body text-center text-md-left">
                                    <div class="source-name">Sam Doe</div>
                                    <div class="soure-title">Co-Founder, Company Integer</div>
                                </div>
                            </div><!--//source-->
                            <div class="icon-holder"><i class="fas fa-quote-right"></i></div>
                        </div><!--//inner-->
                    </div><!--//item-->
                </div><!--//row-->
                <div class="text-center">
                    <a class="btn btn-primary" href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/devbook-free-bootstrap-4-book-ebook-landing-page-template-for-developers/">Get Your Copy Today</a>
                </div>
            </div><!--//container-->
        </section><!--//reviews-section-->
        
        <section class="author-section section theme-bg-primary py-5">
            <div class="container py-3">
                <div class="author-profile text-center mb-5">
                    <img class="author-pic" src="https://demos.onepagelove.com/html/devbook/assets/images/profiles/author-profile.png" alt="image">
                </div><!--//author-profile-->
                <h2 class="section-heading text-center text-white mb-3">About The Author</h2>
                <div class="author-bio single-col-max mx-auto">
                    <p>This book landing page template is made by product designer <a class="theme-link" href="http://themes.3rdwavemedia.com/" target="_blank">Xiaoying Riley</a> for developers. You can use this template to self-publish and promote your book/ebook. You can easily use platforms such as <a class="theme-link" href="https://gumroad.com/" target="_blank">Gumroad</a> to handle your book payment and delivery.</p>
                    <p> This template is 100% FREE as long as you <strong>keep the footer attribution link</strong>. You do not have the rights to resell, sublicense or redistribute (even for free) the template on its own or as a separate attachment from any of your work. If you???d like to use this template without the footer attribution link, you can buy the <a class="theme-link" href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/devbook-free-bootstrap-4-book-ebook-landing-page-template-for-developers/" target="_blank"><strong>commercial license</strong></a>.</p>
                    <div class="author-links text-center pt-4">
                        <h5 class="text-white mb-4">Follow Author</h5>
                        <ul class="social-list list-unstyled">
                            <li class="list-inline-item"><a href="https://twitter.com/3rdwave_themes"><i class="fab fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="https://github.com/xriley"><i class="fab fa-github-alt"></i></a></li> 
                            <li class="list-inline-item"><a href="https://medium.com/@3rdwave_themes"><i class="fab fa-medium-m"></i></a></li>
                            
                            <li class="list-inline-item"><a href="https://themes.3rdwavemedia.com/"><i class="fas fa-globe-europe"></i></a></li>
                        </ul><!--//social-list-->
                    </div><!--//author-links-->
                    
                </div><!--//author-bio-->
                
            </div><!--//container-->
        </section><!--//author-section-->		
    
        
        
        
     @endif 
     <footer class="footer">
        <div class="footer-bottom text-center py-5">
            <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can buy the commercial license via our website: themes.3rdwavemedia.com */-->
            <small class="copyright">Designed with <a class="theme-link" href="/" target="_blank">TheLandyng</a></small>
        </div>			
    </footer>
     <a class="edit-btn"  href="{{route('client.landing.edit_template',$landing->id)}}" target="_blank"><i class="fas fa-pencil-alt"></i> Edit</a>

    <!-- Javascript -->          
    <script src="https://demos.onepagelove.com/html/devbook/assets/plugins/jquery-3.4.1.min.js"></script>
    <script src="https://demos.onepagelove.com/html/devbook/assets/plugins/popper.min.js"></script>
    <script src="https://demos.onepagelove.com/html/devbook/assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
    <script src="https://demos.onepagelove.com/html/devbook/assets/plugins/jquery.scrollTo.min.js"></script>  
    <script src="https://demos.onepagelove.com/html/devbook/assets/plugins/back-to-top.js"></script>  
    <script src="https://use.fontawesome.com/f2974dff49.js"></script>
    
    <script src="https://demos.onepagelove.com/html/devbook/assets/js/main.js"></script>


</body>

</html> 

