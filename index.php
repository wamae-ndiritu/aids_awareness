<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font awesome icons -->
    <script src="https://kit.fontawesome.com/7668282ff5.js" crossorigin="anonymous"></script>
    <title>knowHIV - HIV/AIDS Awareness</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <!-- Link Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Custom CSS -->
</head>

<body>
    <?php include 'includes/header.php' ?>
    <!-- Slider Start -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <img src="images/HIV-1.jpeg" class="slide-image" alt="Slide 1 Image">
                <div class="text-overlay">
                    <h2 class="text-4xl font-semibold">Empowering Youth Against HIV/AIDS</h2>
                    <p class="text-xl md:max-w-3xl">Join us in empowering the youth with knowledge and resources to
                        prevent HIV/AIDS. Together, we can build a future free from the threat of this epidemic.</p>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide">
                <img src="images/awareness-1.jpeg" class="slide-image" alt="Slide 2 Image">
                <div class="text-overlay">
                    <h2 class="text-4xl font-semibold">Breaking the Silence: Talking About HIV/AIDS</h2>
                    <p class="text-xl md:max-w-3xl">Break the silence and start a conversation about HIV/AIDS. By openly
                        discussing prevention
                        strategies and promoting safe behaviors, we can overcome stigma and create a supportive
                        community.</p>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide">
                <img src="images/healthy-relationships.png" class="slide-image" alt="Slide 3 Image">
                <div class="text-overlay">
                    <h2 class="text-4xl font-semibold">Building Healthy Relationships</h2>
                    <p class="text-xl md:max-w-3xl">Healthy relationships are the foundation of a thriving community.
                        Learn how to cultivate respectful, supportive relationships and make informed decisions to
                        protect yourself and your partners from HIV/AIDS.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About Section -->
    <section class="my-5 px-4 md:px-16" id="about">
        <h2 class="text-3xl font-semibold text-center text-red-600 my-3">About knowHIV</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="col-span-1 p-4 md:py-8 text-gray-600 font-sans">
                <p>Our platform serves as a beacon of hope and information, offering a wealth of resources, support, and
                    community connections for those affected by HIV/AIDS. From comprehensive educational materials and
                    prevention strategies to uplifting stories of resilience and solidarity, [Platform Name] is your
                    trusted ally in navigating the complexities of HIV/AIDS. </p>
                <p class="py-3">Join us as we work tirelessly to raise awareness, challenge stigma, and build a brighter
                    future for individuals affected by HIV/AIDS. Together, we can create a world where HIV/AIDS is
                    understood, accepted, and ultimately eradicated.</p>
                <p class="py-3">Driven by a commitment to inclusivity and compassion, we strive to create a welcoming
                    space where everyone feels valued, respected, and supported. Whether you're seeking knowledge,
                    seeking support, or seeking to make a difference, [Platform Name] is here to guide you every step of
                    the way.</p>
            </div>
            <div class="col-span-1 p-4">
                <img src="images/together-we-can.jpeg" alt="About knowHIV" class="flex-grow-1 h-96">
            </div>
        </div>
    </section>
    <!-- About Section -->
    <!-- Join our community section -->
    <section class="my-5 px-4 md:px-16" id="join-our-community">
        <h2 class="text-3xl font-semibold text-center text-red-600 my-3">Joining Our Community</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="col-span-1 p-4">
                <img src="images/community.jpeg" alt="Our Community" class="flex-grow-1 h-96">
            </div>
            <div class="col-span-1 p-4 text-gray-600 font-sans">
                <p>Our community platform provides a safe and inclusive space where you can:</p>
                <ul class="pl-10 m-0 my-2 list-disc">
                    <li>View Posts and tips</li>
                    <li>Share Posts</li>
                    <li>Engage with Others</li>
                </ul>
                <p class="py-3">Whether you're seeking information, looking to share your story, or simply want to
                    connect with
                    others
                    who are passionate about HIV/AIDS awareness, our community is here for you.</p>
                <p class="py-3">Join us today and be a part of the movement to create a world where HIV/AIDS is
                    understood, accepted,
                    and
                    ultimately eradicated.</p>
                <div class="flex justify-center my-3">
                    <a href="register.php" class="bg-red-500 text-white rounded-full px-4 py-2">Sign Up Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Benefits of Our Community -->
    <section class="my-5 px-4 md:px-16" id="community-benefits">
        <h2 class="text-3xl font-semibold text-center text-red-600 my-3">Discover the Benefits of Our Community</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-gray-600 font-sans">
            <div class="col-span-1 flex flex-col items-center">
                <i class="fa fa-search text-2xl"></i>
                <h3 class="text-red-600 my-1 text-xl">Explore Posts</h3>
                <p>Explore a wealth of informative and inspiring posts about HIV/AIDS awareness, prevention,
                    treatment, and support.</p>
            </div>
            <div class="col-span-1 flex flex-col items-center">
                <i class="fa fa-share text-2xl"></i>
                <h3 class="text-red-600 my-1 text-xl">Share Posts</h3>
                <p>Contribute to the conversation by sharing your own experiences, insights, and resources related
                    to HIV/AIDS.</p>
            </div>
            <div class="col-span-1 flex flex-col items-center">
                <i class="fa fa-comments text-2xl"></i>
                <h3 class="text-red-600 my-1 text-xl">Engage with Others</h3>
                <p>Connect with like-minded individuals, share knowledge, and offer support to those in need through
                    comments and discussions.</p>
            </div>
        </div>
    </section>

    <!-- Slider End -->
    <!-- Link Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="JS/index.js"></script>
</body>

</html>