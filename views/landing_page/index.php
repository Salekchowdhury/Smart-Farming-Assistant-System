<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
use App\DataManipulation\DataManipulation;
$datamanipulation = new DataManipulation();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Smart Farming System</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="fontawesome/css/fontawesome.css">

    </head>

    <body>
        <!-- <navabr start> -->
        <nav class="navbar navbar-expand-lg bg-dark fixed-top">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white active"
                               aria-current="page" href="#home">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="#service">Service</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#product">Product</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="#contact">Contacts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../login_register_forgot/login.php">Sign in</a>
                        </li>

                    </ul>
                    <span>
					    <div class="translate" id="google_translate_element"></div>

                            <script type="text/javascript">
                                function googleTranslateElementInit() {  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');}
                            </script>
                            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
					</span>
                </div>
              <h4 class="text-white text-center">Smart Farming Assistant System</h4>
                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
        </nav>
        <!-- <navabr end> -->

        <!-- <landing section start> -->

        <section id="home" class="bg-dark">

            <div>

                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="img/f1.jpg" height="" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="img/f2.jpg" height="" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="img/f3.jpg" height="" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="img/f4.jpg" height="" alt="Second slide">
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </section>

        <section id="service" class="bg-dark text-white py-2">
                <div class="container">
                    <div class="text-center mt-5">
                        <h5 class="text-uppercase">Our Services</h5>
                        <h2 class="text-uppercase font-weight-bold">services</h2>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4 p-2">
                            <div class="height-vh-27 shadow-box border text-center
                            rounded p-3">
                                <div class="my-2">
                                    <img  class="p-2" src="img/subscription.png" width="75" height="75" style="border-radius: 50% ; border: 1px solid white">
                                </div>
                                <h5 class="text-uppercase">Subscription</h5>
                            </div>
                        </div>
                        <div class="col-md-4 p-2">
                            <div class="height-vh-27 shadow-box border text-center
                            rounded p-3">
                                <div class="my-2">
                                    <img class="p-2" src="img/chat.png" width="75" height="75" style="border-radius: 50%; border: 1px solid white">
                                </div>
                                <h5 class="text-uppercase">Chat</h5>
                            </div>
                        </div>
                        <div class="col-md-4 p-2">
                            <div class="height-vh-27 shadow-box border text-center
                            rounded p-3">
                                <div class="my-2">
                                    <img  class="p-2" src="img/help.png" width="75" height="75" style="border-radius: 50%; border: 1px solid white">
                                </div>
                                <h5 class="text-uppercase">Expert Help</h5>

                            </div>
                        </div>

                    </div>
                    <div class="row mt-lg-2">
                        <div class="col-md-4 p-2">

                            <!-- <i class="fa fa-handshake-o " aria-hidden="true"></i> -->
                            <div class="height-vh-27 shadow-box border text-center
                            rounded p-3">
                                <div class="my-2">
                                    <img  class="p-2" src="img/consumer.png" width="75" height="75" style="border-radius: 50%; border: 1px solid white">
                                </div>
                                <h5 class="text-uppercase">Find Consumer</h5>

                            </div>
                        </div>
                        <div class="col-md-4 p-2">
                            <div class="height-vh-27 shadow-box border text-center
                            rounded p-3">
                                <div class="my-2">
                                    <img  class="p-2" src="img/farmer.png" width="75" height="75" style="border-radius: 50%; border: 1px solid white">
                                </div>
                                <h5 class="text-uppercase">Find Farmer</h5>
                            </div>
                        </div>
                        <div class="col-md-4 p-2">
                            <div class="height-vh-27 shadow-box border text-center
                            rounded p-3">
                                <div class="my-2">
                                    <img  class="p-2" src="img/rating.png" width="75" height="75" style="border-radius: 50%; border: 1px solid white">
                                </div>
                                <h5 class="text-uppercase">Rating</h5>

                            </div>
                        </div>

                    </div>

                </div>

        </section>
        <!-- <Services section end> -->

        <!-- < contact section Start> -->

        <section id="product" class="bg-dark">

               <div class="container">
                   <div class="text-center mt-5 py-4">
                       <h5 class="text-uppercase text-white">Our Product</h5>
                       <h2 class="text-uppercase font-weight-bold text-white">Products</h2>
                   </div>
                   <div class="row pl-2 mt-2">
                   <?php
                   $allProducts = $datamanipulation->showAllproduct();

                   if($allProducts){
                       foreach ($allProducts as $allProduct){
                           ?>
                           <div class="col-md-4 p-2">
                               <div class="height-vh-27 shadow-box border text-center
                            rounded p-3">
                                   <div class="my-2">
                                       <img  class="p-2" src="<?php echo $allProduct->image?>" width="75" height="75" style="border-radius: 50% ; border: 1px solid white">
                                   </div>
                                   <div class="">
                                       <span style="font-size: 18px" class="text-light">Name: <?php echo $allProduct->product_name?></span><br>
                                       <span style="font-size:18px" class="text-light">Price: <?php echo $allProduct->price?></span><br>
                                   </div>
                               </div>
                           </div>

                       <?php }}?>
               </div>
            </div>
        </section>
        <section id="contact" class="bg-dark">
            <div class="container">
                <div class="row bg-dark mt-4">
                    <div class="col-md-6 ">
                        <div class="text-center mt-3 text-white mb-2">
                            <h5 class="text-uppercase">Contact form</h5>
                            <?php
                            if(isset($_SESSION['SendMessage'])){
                                echo $_SESSION['SendMessage'];
                                unset($_SESSION['SendMessage']);
                            }
                            ?>
<!--                            <h2 class="text-uppercase font-weight-bold">Get in Touch</h2>-->
                        </div>
                        <form action="../process/email.php" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-12">
<!--                                    <lable for="firstName"> Name</lable>-->
                                    <input type="text" name="name" class="form-control"
                                           placeholder=" Name" id="firstName">
                                </div>
                            </div>
                            <div class="form-group">
<!--                                <lable for="email">Email</lable>-->
                                <input type="email" name="email" class="form-control"
                                       placeholder="Your Email" id="email">
                            </div>
                            <div class="form-group">
<!--                                <lable for="subject">Subject</lable>-->
                                <input type="text" name="subject" class="form-control"
                                       placeholder="Your Subject" id="subject">
                            </div>
                            <div class="form-group">
<!--                                <lable for="email">Message</lable>-->
                                <textarea class="form-control" name="message" placeholder="Your Message"></textarea>
                            </div>
                            <button type="submit" class=" mb-2 btn btn-primary" name="message_from_home_page">Submit</button>
                        </form>
                    </div>
                    <div class="col-md-6 mt-4 bg-dark">

                     <div class=" mt-4">
                         <div class=" bg-dark text-white">
                             <div class="card-header">
                                 <div class="row">
                                     <div class="col-md-6">
                                         <h3>About Me</h3>
                                         <strong>NAME:</strong>
                                         <P>Marjia Mahjabin Rafia</P>
                                         <strong>EMAIL:</strong>
                                         <P>mahjabin865@gmail.com</P>
                                         <P>smartfarmingassistantsystem@gmail.com</P>
                                         <strong>ROLE:</strong>
                                         <P>Developer</P>
                                         <strong>PHONE:</strong>
                                         <P>+8801879727083</P>
                                     </div>
                                     <div class="col-md-6">
                                      <img src="img/person_1.jpg" width="200" height="200" style="border-radius: 50%">
                                     </div>

                                 </div>

                             </div>
                         </div>
                     </div>
                    </div>
                </div>

            </div>

        </section>
        <!-- < contact section end> -->

        <!-- <Footer section Start> -->
        <section id="footer  text-center" class="bg-dark my-4">
            <div class="container my-3">
                <div class="row bg-dark mt-4 text-white">
                    <div class="col-md-6 mt-2 text-center">
                        <h4 class="text-left">Quick Links</h4>
                        <div class="text-white d-flex flex-column justify-content-start">
                            <a href="#home" class="text-white text-left">Home</a>
                            <a href="#service" class="text-left">Service</a>
                            <a href="#product" class="text-left">Product</a>
                            <a href="#contact" class="text-left">Contact</a>
                            <a class="text-left" href="../login_register_forgot/login.php">Sign in</a>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2 d-flex flex-column text-center ">
                        <h4 class="text-left">Follow Us</h4>
                        <a class="text-left" href="#" class="">facebook</a>
                        <a class="text-left" href="#">Twitter</a>
                        <a class="text-left" href="#">Instagram</a>
                      
                    </div>

                </div>
            </div>
        </section>
        <!-- <Footer section end> -->

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>

</html>