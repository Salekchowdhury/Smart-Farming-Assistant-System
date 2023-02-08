<?php
if(!isset($_SESSION)){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Smart Farming</title>
        <link rel="stylesheet" href="../font_page/css/style.css">
        <link rel="stylesheet" href="../font_page/css/style.css">
        <link rel="stylesheet" href="../font_page/css/bootstrap.min.css">
        <link rel="stylesheet" href="../font_page/css/responsive.css">
        <link rel="stylesheet" href="../font_page/fontawesome/css/fontawesome.css">
        <link rel="icon" href="../font_page/img/favicon.ico">
    </head>

    <body>
        <!-- <navabr start> -->
        <nav class="navbar navbar-expand-lg bg-info fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand text-light" href="#">
                    SMART FARMING
<!--                    <img src="img/logo.png">-->
                </a>
                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white active"
                                aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#services">Service</a>
                        </li>
<!--                        <li class="nav-item">-->
<!--                            <a class="nav-link text-white" href="#testimonial">Testimonials</a>-->
<!--                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#contact">Contacts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../../views/login_register_forgot/login.php">Sign in</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <section id="home">
            <div class="container">
                <div class="row">
                    <div class="home-center text-center">
                        <h2 class="text-light">SMART FARMING</h2>
                        <p>Our system has been made very simple keeping all types of farmers in mind so that it can be used easily.
                            By using this system o can easily buy and sell products as well as communicate easily with each other
                        </p>
<!--                        <div class="home-btn">-->
<!--                            <a href="#" class="btn btn-shop">Shop Now</a>-->
<!--                            <a href="#" class="btn btn-menu">Get Started</a>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </section>
        <section id="services">
            <div class="container">
                <div class="text-center mt-5">
                    <h5 class="text-uppercase">Our Services</h5>
                    <h2 class="text-uppercase font-weight-bold">we Offer
                        services</h2>
                </div>
                <div class="row mt-5">
                    <div class="col-md-4 p-2">
                        <div class="height-vh-27 shadow-box border text-center
                            rounded p-2">
                            <div>
                                <img class="p-1" src="../font_page/sf_service_icon/farmer-images-png.png" height="70" width="70" style="border: 1px solid green; border-radius: 50%">
                            </div>
                            <h5 class="text-uppercase">Farmer</h5>
                            <p>Farmers can create accounts and sell their products</p>

                        </div>
                    </div>
                    <div class="col-md-4 p-2">
                        <div class="height-vh-27 shadow-box border text-center
                            rounded p-2">
                            <div>
                                <img class="p-1" src="../font_page/sf_service_icon/consumer.png" height="70" width="70" style="border: 1px solid green; border-radius: 50%">
                            </div>
                            <h5 class="text-uppercase">consumer</h5>
                            <p>Consumers can easily view and purchase products as well as communicate with farmers through chat.</p>
<!--                            <p><a href="#">See More...</a></p>-->
                        </div>
                    </div>
                    <div class="col-md-4 p-2">

                        <div class="height-vh-27 shadow-box border text-center
                            rounded p-2">
                            <div>
                                <img class="p-1" src="../font_page/sf_service_icon/subscription.png" height="70" width="70" style="border: 1px solid green; border-radius: 50%">
                            </div>
                            <h5 class="text-uppercase">Subscription</h5>
                            <p>Farmers have to pay subscription fee of 1000 taka per month to use this service.</p>
<!--                            <p><a href="#">See More...</a></p>-->
                        </div>
                    </div>
                </div>
                <div class="row mt-lg-2">
                    <div class="col-md-4 p-2">
                        <div class="height-vh-27 shadow-box border text-center
                            rounded p-2">
                            <div>
                                <img class="p-1" src="../font_page/sf_service_icon/chat.png" height="70" width="70" style="border: 1px solid green; border-radius: 50%">
                            </div>
                            <h5 class="text-uppercase">Chat System</h5>
                            <p>Farmers can easily communicate with consumers and experts through chat.</p>
<!--                            <p><a href="#">See More...</a></p>-->
                        </div>
                    </div>
                    <div class="col-md-4 p-2">
                        <div class="height-vh-27 shadow-box border text-center
                             rounded p-2">
                            <div>
                                <img class="p-1" src="../font_page/sf_service_icon/rating.png" height="70" width="70" style="border: 1px solid green; border-radius: 50%">
                            </div>
                            <h5 class="text-uppercase">Rating</h5>
                            <p>Consumers can rate and view ratings</p>
<!--                            <p><a href="#">See More...</a></p>-->
                        </div>
                    </div>
                    <div class="col-md-4 p-2">
                        <div class="height-vh-27 shadow-box border text-center
                             rounded p-2">
                            <div>
                                <img class="p-1" src="../font_page/sf_service_icon/expert-care.jpg" height="70" width="70" style="border: 1px solid green; border-radius: 50%">
                            </div>
                            <h5 class="text-uppercase">Expert Help</h5>
                            <p>Farmers can contact experts to know about various diseases.</p>
<!--                            <p><a href="#">See More...</a></p>-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!--        <section id="testimonial">-->
<!--            <div class="container">-->
<!--                <div class="text-center mt-5">-->
<!--                    <h5 class="text-uppercase">People Says</h5>-->
<!--                    <h2 class="font-weight-bold text-uppercase">Testimonials</h2>-->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="carousel slide" data-ride="carousel">-->
<!--                            <div class="carousel-inner">-->
<!--                                <div class="carousel-item active">-->
<!--                                    <img src="img/person_1.jpg" alt="First-->
<!--                                        Slide">-->
<!--                                    <div class="mt-3">-->
<!--                                        <h5>Lorem ipsum dolor sit amet.</h5>-->
<!--                                        <p>Lorem ipsum dolor sit amet-->
<!--                                            consectetur adipisicing.</p>-->
<!--                                        <button class="btn btn-info">Read More</button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="carousel-item">-->
<!--                                    <img src="img/person_2.jpg" alt="First-->
<!--                                        Slide">-->
<!--                                    <div class="mt-3">-->
<!--                                        <h5>Lorem ipsum dolor sit amet.</h5>-->
<!--                                        <p>Lorem ipsum dolor sit amet-->
<!--                                            consectetur adipisicing.</p>-->
<!--                                        <button class="btn btn-info">Read More</button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="carousel-item">-->
<!--                                    <img src="img/person_3.jpg" alt="First-->
<!--                                        Slide">-->
<!--                                    <div class="mt-3">-->
<!--                                        <h5>Lorem ipsum dolor sit amet.</h5>-->
<!--                                        <p>Lorem ipsum dolor sit amet-->
<!--                                            consectetur adipisicing.</p>-->
<!--                                        <button class="btn btn-info">Read More</button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="carousel-item">-->
<!--                                    <img src="img/person_4.jpg" alt="First-->
<!--                                        Slide">-->
<!--                                    <div class="mt-3">-->
<!--                                        <h5>Lorem ipsum dolor sit amet.</h5>-->
<!--                                        <p>Lorem ipsum dolor sit amet-->
<!--                                            consectetur adipisicing.</p>-->
<!--                                        <button class="btn btn-info">Read More</button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </section>-->
        <section id="contact">
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <?php
                    if(isset($_SESSION['SendMessage'])){
                        echo $_SESSION['SendMessage'];
                        unset($_SESSION['SendMessage']);
                    }
                    ?>
                </div>
                <div class="col-md-4">

                </div>

            </div>

            <div class="container">
                <div class="text-center mt-5">
                    <h5 class="text-uppercase">Contact form</h5>
                    <h2 class="text-uppercase font-weight-bold">Get in Touch</h2>
                </div>
                <form action="../../views/process/email.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <lable for="firstName"> Name</lable>
                            <input type="text" name="name" class="form-control"
                                placeholder="Name" id="firstName">
                        </div>
                    </div>
                    <div class="form-group">
                        <lable for="email">Email</lable>
                        <input type="email" name="email" class="form-control"
                            placeholder="Your Email" id="email">
                    </div>
                    <div class="form-group">
                        <lable for="subject">Subject</lable>
                        <input type="text" name="subject" class="form-control"
                            placeholder="Your Subject" id="subject">
                    </div>
                    <div class="form-group">
                        <lable for="email">Message</lable>
                        <textarea name="message" class="form-control" placeholder="Type Your Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="message_by_users">Submit</button>
                </form>
            </div>
        </section>
        <section id="footer  text-center ">
            <div class="container">
                <div class="row bg-info mt-4 text-white">
                    <div class="col-md-4 about-me mt-2">
                        <h4>About Me</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Atque laborum vel consectetur placeat corporis, nulla,
                              autem ipsum minima.</p>
                    </div>
                    <div class="col-md-4 mt-2">
                        <h4>Quick Links</h4>
                        <div class="text-white d-flex flex-column">
                            <a href="#home" class="text-white">Home</a>
                            <a href="#services">Services</a>
                            <a href="#contact">Contact</a>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2 d-flex flex-column ">
                        <h4>Follow Us</h4>
                        <a href="#" class="">facebook</a>
                        <a href="#">Twitter</a>
                        <a href="#">Instagram</a>
                    </div>
                    <div class="m-auto">
                        <p class="text-dark">Copy &copy <a href="" class="text-dark">rafia</a></p>
                    </div>
                </div>
            </div>
        </section>
        <script src="../font_page/js/jquery.min.js"></script>
        <script src="../font_page/js/bootstrap.min.js"></script>
    </body>
</html>