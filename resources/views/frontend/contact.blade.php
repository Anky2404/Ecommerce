<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.head')

<body>
    @include('frontend.partials.header')
    <section class="banner">
        <div class="container-wrap">
            <h1>Contact Us</h1>
        </div>
    </section>
    <section class="contact">
        <div class="container-wrap">
            <div class="contact-left">
                <div class="row-wrap">

                    <div class="col4">
                        <div class="contact-box">
                            <div class="icon">
                                <i class="fa-solid fa-location-crosshairs"></i>
                            </div>
                            <div class="info">
                                <h3>Our Location</h3>
                           
                                    <p>FashionCraze Ltd.
                                        123 High Street,
                                        London, WC2N 5DU,
                                        United Kingdom </p>
                           
                            </div>
                        </div>
                    </div>
                    <div class="col4">

                        <div class="contact-box">
                            <div class="icon">
                                <i
                                        class="fa-solid fa-phone"></i>
                               
                            </div>
                            <div class="info">
                                <h3>24/7 </h3>
                                <a href="tel:+44 20 7946 1234"><p>+44 20 7946
                                    1234 </p></a>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col4">
                        <div class="contact-box">
                            <div class="icon">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <div class="info">
                                <h3>Email</h3>
                                <a href="mailto:info@fashioncraze.co.uk">
                                    <p>info@fashioncraze.co.uk </p>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>
    <section class="login register" id="contact">
        <div class="container-wrap">

            <div class="login-form" >
                <form method="POST" action="{{ route('user.sent-queries') }}">
                    @csrf
                    <h2>Send Message</h2>
                
                    <div class="input-group">
                        <div class="input-wrap">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter Name" required>
                        </div>
                
                        <div class="input-wrap">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter Email" required>
                        </div>
                    </div>
                
                    <div class="input-group">
                        <div class="input-wrap">
                            <label for="contact">Contact</label>
                            <input type="text"  name="contact" placeholder="Enter Contact" required>
                        </div>
                
                        <div class="input-wrap">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" placeholder="Enter Subject" required>
                        </div>
                    </div>
                
                    <div class="input-wrap">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Enter Message" required></textarea>
                    </div>
                
                    <button type="submit" class="btns">Send Message</button>
                </form>
                
            </div>
        </div>

    </section>
   @include('frontend.partials.footer')
</body>

</html>