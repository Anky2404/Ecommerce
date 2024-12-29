<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.head')

<body>
    @include('frontend.partials.header')
    <section class="about-us">
        <div class="container-wrap">
            <h1>About FashionCraze: Redefining Style</h1> <p><strong>FashionCraze: Your style, your statement.</strong></p>
            <div class="row-wrap">
                <div class="col6">
                    <p>At FashionCraze, we believe fashion is more than just clothing—it's a form of self-expression that empowers confidence and individuality. Founded with a passion for style and a commitment to quality, we strive to offer a seamless shopping experience that caters to every personality, occasion, and budget.</p>
                    <p>FashionCraze isn’t just about selling clothes; it's about building a community where fashion enthusiasts can discover inspiration, celebrate uniqueness, and connect through shared love for style.</p>
               
                    <img src="{{asset('frontend_assets/images/about1.jpg')}}"alt="About FashionCraze" title="About FashionCraze">
                </div>
                <div class="col6">
                    <p>Our collections are thoughtfully curated to bring you the latest trends alongside timeless classics, ensuring you have access to a versatile wardrobe that speaks to who you are. From everyday essentials to statement pieces, every item is crafted with care, combining premium materials with exceptional designs.</p>
                    <p>We are dedicated to sustainability and ethical practices, aiming to make a positive impact on the world while keeping you stylish. Join us on this journey to redefine fashion—one outfit at a time.</p>
                   
                    <img src="{{asset('frontend_assets/images/about2.jpg')}}"alt="About FashionCraze" title="About FashionCraze">
                   
                </div>
            </div>
        </div>
    </section>

<section class="about">
    <div class="container-wrap">
        <div class="row-wrap">
            <div class="col6">
                <div class="about-left">
                    <h2>Our Commitment to Style & Sustainability</h2>
                    <p>At FashionCraze, our mission extends beyond fashion. We are committed to creating a positive impact by embracing sustainable practices and supporting ethical production. Our collections are thoughtfully designed to not only make you look good but also feel good about the choices you make.</p>
                </div>
            </div>
            <div class="col6">
                <div class="about-right">
                    <div class="row-wrap">
                        <div class="col6">
                            <div class="about-box">
                                <span>1,000+</span>
                                <p>Unique Styles</p>
                            </div>
                        </div>
                        <div class="col6">
                            <div class="about-box">
                                <span>500+</span>
                                <p>Happy Customers Daily</p>
                            </div>
                        </div>
                        <div class="col6">
                            <div class="about-box">
                                <span>100% </span>
                                <p>Sustainable Fabrics</p>
                            </div>
                        </div>
                        <div class="col6">
                            <div class="about-box">
                                <span>24/7</span>
                                <p>Customer Support</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.partials.footer')
</body>

</html>