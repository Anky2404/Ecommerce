-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2024 at 01:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address_type` enum('customer_address','seller_address') NOT NULL,
  `suburb` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `postal_code` varchar(8) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `location_type` enum('Home','Office','Others') NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `baskets`
--

CREATE TABLE `baskets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `baskets`
--

INSERT INTO `baskets` (`id`, `product_id`, `customer_id`, `quantity`, `added_at`) VALUES
(10, 37, 7, 3, '2024-12-28 12:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` text NOT NULL,
  `category_img` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_description`, `category_img`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Tops', 'Explore a wide range of fashionable tops including shirts, blouses, and T-shirts for every occasion. From casual wear to formal options, our collection ensures you stay stylish and comfortable. Available in various materials like cotton, silk, and polyester, these tops suit every weather. Choose from a spectrum of colors and patterns that cater to your unique taste. Perfect for layering or as stand-alone pieces, these tops redefine modern fashion.', 'tops.jpg', 1, '2024-12-28 00:29:30', '2024-12-28 00:29:57'),
(2, 'Bottoms', 'Our bottoms collection features jeans, trousers, skirts, and shorts designed to meet diverse fashion needs. Whether you are dressing up for work, a casual day out, or a night on the town, we have the perfect fit for you. Available in a variety of cuts, styles, and fabrics, our bottoms ensure comfort without compromising on style. Enjoy versatility with options ranging from skinny jeans to flowy skirts. Explore durable and stylish wear for every season.', 'bottoms.jpg', 1, '2024-12-28 00:29:30', '2024-12-28 00:30:01'),
(3, 'Outerwear', 'Stay warm and stylish with our premium outerwear collection, including jackets, coats, and hoodies. Designed to protect you from the elements while keeping your fashion game strong, these pieces are a wardrobe essential. Crafted with high-quality materials like wool, leather, and synthetic blends, they combine functionality with elegance. Available in trendy and classic styles, our outerwear suits all occasions, whether casual or formal.', 'outerwear.jpg', 1, '2024-12-28 00:29:30', '2024-12-28 00:30:15'),
(4, 'Footwear', 'Step out in confidence with our wide range of footwear, including shoes, sneakers, and boots. Designed for all occasions, our collection ensures the perfect blend of comfort and style. From lightweight running shoes to elegant formal shoes, our footwear caters to your every need. Durable materials and ergonomic designs make our collection both practical and fashionable. Available in a variety of sizes, colors, and designs, our footwear complements any outfit.', 'footwear.jpg', 1, '2024-12-28 00:29:30', '2024-12-28 00:30:21'),
(5, 'Accessories', 'Complete your look with our stunning accessories, including scarves, belts, gloves, and more. Each piece is carefully designed to add a touch of elegance and personality to your outfit. From warm and cozy winter accessories to sleek and stylish belts, we have options for every season. Our collection is crafted from premium materials, ensuring durability and timeless appeal. Discover how the right accessories can elevate your style effortlessly.', 'accessories.jpg', 1, '2024-12-28 00:29:30', '2024-12-28 00:30:35'),
(6, 'Activewear', 'Get ready to conquer your fitness goals with our activewear collection, featuring performance-driven designs. From breathable leggings and T-shirts to supportive sports bras and jackets, our activewear keeps you comfortable during workouts. Crafted with moisture-wicking fabrics and ergonomic fits, these pieces ensure optimal performance. Suitable for yoga, running, gym sessions, and more, our collection inspires you to stay active in style.', 'activewear.jpg', 1, '2024-12-28 00:29:30', '2024-12-28 00:30:40'),
(7, 'Formal Wear', 'Make a lasting impression with our sophisticated formal wear collection. From tailored suits and elegant dresses to stylish blazers and dress shirts, our range is perfect for business meetings, weddings, and other formal events. Designed with premium materials, these outfits offer a perfect balance of comfort and class. Choose from classic and modern styles to suit your taste. Elevate your wardrobe with pieces that exude professionalism and charm.', 'formalwear.jpg', 1, '2024-12-28 00:29:30', '2024-12-28 00:30:53'),
(8, 'Casual Wear', 'Discover the perfect balance of comfort and style with our casual wear collection. Ideal for everyday activities, these outfits include comfortable T-shirts, cozy hoodies, relaxed jeans, and more. Available in vibrant colors and trendy designs, our casual wear suits any laid-back occasion. Crafted from high-quality fabrics, these pieces ensure long-lasting comfort. Perfect for creating a relaxed yet fashionable look.', 'casualwear.jpg', 1, '2024-12-28 00:29:30', '2024-12-28 00:31:06'),
(9, 'Kids Fashion', 'Let your little ones shine with our adorable kids fashion collection. From trendy outfits to playful accessories, our range is designed with childrens comfort and style in mind. Available in a variety of colors, patterns, and themes, these clothes suit any occasion, from playdates to family gatherings. Made with soft, breathable fabrics, our kids collection ensures freedom of movement and durability. Dress your child in fashion that’s fun and functional.', 'kidsfashion.jpg', 1, '2024-12-28 00:29:30', '2024-12-28 00:31:12'),
(10, 'Party Wear', 'Steal the spotlight with our glamorous party wear collection. Featuring dazzling dresses, sharp suits, and stylish accessories, our range is perfect for any celebration. Crafted with luxurious materials like silk, velvet, and sequins, these outfits ensure you stand out. Available in bold colors and intricate designs, our party wear combines elegance with comfort. Get ready to celebrate in style with outfits that make every occasion memorable.', 'partywear.jpg', 1, '2024-12-28 00:29:30', '2024-12-28 00:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `type` enum('percentage','fixed') NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `min_order_value` decimal(10,2) NOT NULL DEFAULT 0.00,
  `usage_limit` int(11) NOT NULL DEFAULT 0,
  `used_count` int(11) NOT NULL DEFAULT 0,
  `status` enum('Active','Inactive','Expired') NOT NULL DEFAULT 'Active',
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `code`, `type`, `value`, `start_date`, `end_date`, `min_order_value`, `usage_limit`, `used_count`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 'WINTER2024', 'percentage', 15.00, '2024-12-01 00:00:00', '2024-12-31 00:00:00', 50.00, 100, 25, 'Active', '15% off on orders above £50, valid until 31st Dec 2024', '2024-12-26 10:57:44', '2024-12-29 08:16:44'),
(2, 'SUMMER50', 'fixed', 50.00, '2024-06-01 00:00:00', '2024-06-30 00:00:00', 100.00, 200, 120, 'Active', 'Get £50 off on any order above £120 during June 2024', '2024-12-26 10:57:44', '2024-12-29 08:16:59'),
(3, 'HOLIDAY10', 'percentage', 10.00, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 20.00, 50, 30, 'Active', '10% off on orders above £30 for the holiday season', '2024-12-26 10:57:44', '2024-12-29 08:17:17'),
(4, 'NEWYEAR2025', 'fixed', 100.00, '2024-12-26 00:00:00', '2025-01-05 00:00:00', 122.00, 500, 50, 'Inactive', 'Celebrate the New Year with £100 off on orders above £122', '2024-12-26 10:57:44', '2024-12-29 08:19:00'),
(5, 'BLACKFRIDAY', 'percentage', 25.00, '2024-11-23 00:00:00', '2024-11-30 00:00:00', 75.00, 300, 275, 'Active', '25% off on all products for Black Friday week', '2024-12-26 10:57:44', '2024-12-26 10:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `due_date` date NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Paid','Unpaid','Partial','Cancelled') NOT NULL,
  `invoice_notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_points`
--

CREATE TABLE `loyalty_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED DEFAULT NULL,
  `points` int(11) NOT NULL,
  `type` enum('Earned','Redeemed') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loyalty_points`
--

INSERT INTO `loyalty_points` (`id`, `customer_id`, `purchase_id`, `points`, `type`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 5, 'Earned', '2024-12-29 05:12:16', '2024-12-29 05:12:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_23_074053_create_session_table', 1),
(5, '2024_12_23_080802_create_user_details_table', 1),
(6, '2024_12_23_082903_create_categories_table', 1),
(7, '2024_12_23_082951_create_products_table', 1),
(8, '2024_12_23_083129_create_product_img_table', 1),
(9, '2024_12_23_083227_create_discounts_table', 1),
(10, '2024_12_23_083428_create_referrals_table', 1),
(11, '2024_12_23_083544_create_product_inventory_table', 1),
(12, '2024_12_23_083635_create_address_table', 1),
(13, '2024_12_23_093901_create_wishlist_table', 1),
(14, '2024_12_23_093930_create_baskets_table', 1),
(15, '2024_12_23_093950_create_orders_table', 1),
(16, '2024_12_23_094019_create_order_items_table', 1),
(17, '2024_12_23_094049_create_loyalty_points_table', 1),
(18, '2024_12_23_094205_create_order_returns_table', 1),
(19, '2024_12_24_045357_create_payments_table', 1),
(20, '2024_12_24_045402_create_invoices_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_status` enum('Placed','Mark In Progress','Shipped','Delivered','Canceled') NOT NULL DEFAULT 'Placed',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `net_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_status`, `order_date`, `total_amount`, `discount_amount`, `net_amount`) VALUES
(1, 8, 'Placed', '2024-12-25 18:30:00', 469.97, 10.00, 459.97);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `total_amount`) VALUES
(3, 1, 43, 2, 199.99, 399.98),
(4, 1, 39, 1, 44.99, 44.99);

-- --------------------------------------------------------

--
-- Table structure for table `order_returns`
--

CREATE TABLE `order_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `return_reason` text NOT NULL,
  `return_status` enum('Pending','Approved','Rejected','Completed') NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `refund_amount` decimal(10,2) NOT NULL,
  `return_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_status` enum('Pending','Completed','Failed','Refunded') NOT NULL,
  `payment_method` enum('Credit Card','Paypal','Bank Transfer') NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `payment_status`, `payment_method`, `payment_amount`, `payment_date`) VALUES
(1, 1, 'Completed', 'Bank Transfer', 459.99, '2024-12-29 08:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `base_price` decimal(10,2) NOT NULL,
  `color` varchar(50) NOT NULL,
  `materials` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_description`, `quantity`, `is_active`, `base_price`, `color`, `materials`, `created_at`, `updated_at`) VALUES
(32, 1, 'Classic White Button-Up Shirt', 'A timeless piece for any wardrobe, this classic white button-up shirt offers a versatile style that works for both casual and professional occasions. The soft cotton fabric ensures breathability and comfort, while the tailored fit provides a sleek and polished look. Its clean, crisp design pairs easily with jeans, trousers, or skirts, making it an essential for layering or wearing on its own. This shirt is perfect for both everyday wear and office attire.', 100, 1, 29.99, 'White', 'Cotton', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(33, 1, 'Silk Blouse with Ruffled Sleeves', 'Elegance meets comfort in this luxurious silk blouse with ruffled sleeves. The soft silk material feels smooth against the skin and drapes beautifully for a sophisticated, feminine silhouette. The delicate ruffles along the sleeves add a touch of drama, making it ideal for formal gatherings, office settings, or dinner dates. Whether worn tucked into trousers or left loose, this blouse brings a refined look to any outfit.', 50, 1, 69.99, 'Blush Pink', 'Silk', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(34, 1, 'Casual Graphic T-Shirt', 'A fun and expressive way to show off your personality, this casual graphic t-shirt features vibrant artwork that adds a creative touch to your everyday look. Made from soft cotton, this t-shirt is perfect for relaxed weekends or as part of a laid-back office dress code. Its comfortable, relaxed fit allows for freedom of movement, and its bold design makes it a statement piece in your casual wardrobe.', 200, 1, 19.99, 'Gray', 'Cotton', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(35, 1, 'Off-Shoulder Cotton Top', 'This off-shoulder cotton top is the perfect combination of comfort and style. The relaxed fit and lightweight fabric make it ideal for warm weather, while the off-shoulder design adds a playful, trendy vibe. Whether paired with shorts or skirts, it’s a go-to option for beach days, picnics, or casual outings. The soft cotton material keeps you cool and comfortable, and the simple yet chic design elevates any casual ensemble.', 150, 1, 24.99, 'Navy Blue', 'Cotton', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(36, 1, 'Long-Sleeve Knit Sweater', 'This cozy long-sleeve knit sweater is a must-have for cooler months. Its soft and stretchy knit fabric ensures maximum comfort and warmth, making it perfect for layering over your favorite shirts or wearing alone. The simple, elegant design makes it versatile for any occasion—casual outings, work, or cozy nights in. The neutral color options allow for easy pairing with any outfit, making it a staple in your seasonal wardrobe.', 80, 1, 39.99, 'Charcoal Gray', 'Acrylic, Wool', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(37, 2, 'High-Waisted Skinny Jeans', 'These high-waisted skinny jeans combine comfort with style. Crafted from stretchy denim, they hug the body perfectly while offering plenty of room for movement. The high-waisted cut elongates the legs, providing a flattering silhouette. Designed with a classic five-pocket style, these jeans can be dressed up with heels or worn casually with sneakers, making them a versatile wardrobe essential.', 120, 1, 49.99, 'Blue', 'Denim', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(38, 2, 'Black Pleated Skirt', 'This black pleated skirt offers an elegant, timeless look with its crisp pleats and flowy design. Ideal for both office and casual wear, it can be styled in many ways—pair it with a blouse for work or a t-shirt for a more relaxed vibe. The lightweight fabric ensures comfort all day long, while the pleating adds texture and movement. This skirt’s versatility makes it an essential piece for every wardrobe.', 75, 1, 34.99, 'Black', 'Polyester', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(39, 2, 'Chino Trousers', 'These chino trousers are the perfect balance of comfort and sophistication. Made from soft, breathable cotton, they feature a slim fit that flatters the legs without being too tight. Ideal for both casual and business-casual settings, these trousers can be paired with a button-down shirt for work or a casual t-shirt for weekends. The versatile design and neutral color make them a staple for any wardrobe.', 90, 1, 44.99, 'Beige', 'Cotton', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(40, 2, 'Denim Shorts with Frayed Hem', 'These denim shorts with a frayed hem offer a laid-back, casual look perfect for summer days. The distressed edges add an edgy vibe, while the classic five-pocket design keeps it functional. Made from high-quality denim, these shorts are comfortable and durable, with just the right amount of stretch for ease of movement. Whether you’re heading to the beach or hanging out with friends, these shorts are an essential for warm weather.', 150, 1, 29.99, 'Light Blue', 'Denim', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(41, 2, 'Wide-Legged Linen Pants', 'Stay cool and stylish with these wide-legged linen pants. The breathable, lightweight fabric ensures comfort in hot weather, while the loose fit provides ease of movement. The simple design makes these pants perfect for both casual and dressier occasions. Pair with a fitted top or a breezy blouse to create a relaxed, effortless look. These linen pants are perfect for beach vacations, summer evenings, or casual days around town.', 120, 1, 39.99, 'White', 'Linen', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(42, 3, 'Wool Blend Double-Breasted Coat', 'Stay warm and stylish with this luxurious wool blend double-breasted coat. The structured design and elegant buttons give it a sophisticated look, while the wool fabric keeps you insulated against the cold. Perfect for both formal and casual occasions, this coat can be worn over a suit or dressed down with jeans. Its timeless design makes it a wardrobe staple for chilly seasons.', 50, 1, 149.99, 'Camel', 'Wool, Polyester', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(43, 3, 'Black Leather Bomber Jacket', 'This black leather bomber jacket combines style with functionality. The soft leather exterior gives it a sleek, modern look, while the cozy interior lining provides warmth and comfort. The classic bomber silhouette includes ribbed cuffs and a zip-up front, making it a perfect addition to any casual wardrobe. Wear it with jeans, skirts, or dresses for an edgy, stylish outfit that never goes out of fashion.', 60, 1, 199.99, 'Black', 'Leather', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(44, 3, 'Quilted Puffer Jacket', 'This quilted puffer jacket is designed to keep you warm without sacrificing style. The lightweight yet insulated design makes it perfect for colder months, while the sleek quilted pattern adds a modern touch. The water-resistant fabric ensures that you stay dry, while the high collar and adjustable cuffs provide extra protection against the elements. Available in multiple colors, this jacket will keep you cozy and fashionable all winter long.', 80, 1, 129.99, 'Navy Blue', 'Polyester', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(45, 3, 'Hooded Trench Coat', 'This hooded trench coat is the perfect blend of functionality and fashion. Featuring a double-breasted design and a removable hood, it’s ideal for unpredictable weather. The belted waist adds shape, while the long length ensures full coverage and protection from the elements. The classic beige color makes it versatile enough to pair with any outfit, from work attire to casual weekend looks.', 70, 1, 139.99, 'Beige', 'Cotton, Polyester', '2024-12-28 06:23:54', '2024-12-28 06:23:54'),
(46, 3, 'Stylish Fleece Hoodie', 'This stylish fleece hoodie is perfect for layering on chilly days. Made from soft fleece, it offers warmth without being too bulky, making it ideal for everyday wear. The front pouch pocket and adjustable drawstring hood add functional details, while the modern design keeps it on trend. Whether worn for a casual day out or lounging at home, this hoodie ensures comfort and style all season long.', 150, 1, 49.99, 'Gray', 'Fleece', '2024-12-28 06:23:54', '2024-12-28 06:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `products_inventory`
--

CREATE TABLE `products_inventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `last_checked` timestamp NOT NULL DEFAULT current_timestamp(),
  `shelf_number` varchar(255) NOT NULL,
  `last_updated_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `is_main` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `is_main`, `is_active`) VALUES
(31, 32, 'classic_white_button_up_shirt.jpg', 1, 1),
(32, 33, 'silk_blouse_with_ruffled_sleeves.jpg', 1, 1),
(33, 34, 'casual_graphic_tshirt.jpg', 1, 1),
(34, 35, 'off_shoulder_cotton_top.jpg', 1, 1),
(35, 36, 'long_sleeve_knit_sweater.jpg', 1, 1),
(36, 37, 'high_waisted_skinny_jeans.jpg', 1, 1),
(37, 38, 'black_pleated_skirt.jpg', 1, 1),
(38, 39, 'chino_trousers.jpg', 1, 1),
(39, 40, 'denim_shorts_with_frayed_hem.jpg', 1, 1),
(40, 41, 'wide_legged_linen_pants.jpg', 1, 1),
(41, 42, 'wool_blend_double_breasted_coat.jpg', 1, 1),
(42, 43, 'black_leather_bomber_jacket.jpg', 1, 1),
(43, 44, 'quilted_puffer_jacket.jpg', 1, 1),
(44, 45, 'hooded_trench_coat.jpg', 1, 1),
(45, 46, 'stylish_fleece_hoodie.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_email` varchar(100) NOT NULL,
  `sender_contact` varchar(15) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `sender_name`, `sender_email`, `sender_contact`, `subject`, `message`, `sent_at`) VALUES
(1, 'Olivia Smith', 'olivia.smith@gmail.co.uk', '+44 7911 123456', 'Inquiry about winter collection', 'Hi, I am interested in your new winter collection. Can you provide more details about the pricing and availability?', '2024-12-29 05:00:00'),
(2, 'Liam Johnson', 'liam.johnson@gmail.co.uk', '+44 7911 654321', 'Order status update', 'I placed an order last week and was wondering when it will be shipped. Could you provide an update?', '2024-12-28 10:15:00'),
(3, 'Sophia Williams', 'sophia.williams@gmail.co.uk', '+44 7911 987654', 'Question about sizing', 'Can you confirm whether the jackets are true to size? I usually wear a medium but I\'m unsure about the fit.', '2024-12-27 03:40:00'),
(4, 'James Brown', 'james.brown@gmail.co.uk', '+44 7911 345678', 'Returns policy', 'Could you please let me know your returns policy for online orders? I\'ve bought a few items recently and may need to return one.', '2024-12-26 14:30:00'),
(5, 'Amelia Taylor', 'amelia.taylor@gmail.co.uk', '+44 7911 876543', 'Shipping fees to UK', 'I\'m trying to place an order, but I would like to know what the shipping fees to the UK are before proceeding.', '2024-12-25 06:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referred_by` bigint(20) UNSIGNED NOT NULL,
  `referred_to` bigint(20) UNSIGNED NOT NULL,
  `referral_code` varchar(255) NOT NULL,
  `reward_earned` decimal(10,2) NOT NULL DEFAULT 0.00,
  `referred_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `referred_by`, `referred_to`, `referral_code`, `reward_earned`, `referred_at`) VALUES
(1, 2, 7, 'REF701496', 5.00, '2024-12-22 03:02:45'),
(2, 3, 8, 'REF638961', 5.00, '2024-12-23 04:02:45'),
(3, 4, 9, 'REF90319', 5.00, '2024-12-20 05:02:45'),
(4, 5, 10, 'REF534713', 5.00, '2024-12-21 06:02:45'),
(5, 6, 11, 'REF402607', 5.00, '2024-12-19 07:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aOXGTiVVSvbiM0mbLbv0clY8oTaf8Uw5L13x0O5d', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiamtHYnRMUThYRFkyTzZHT1JqSnJYcUJIdUR1THhJVXg1UjVtOEhKNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9BZG1pbi9Mb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1735470549),
('JldyGTJQP18by4dRL1cPiGyoLiXhEGlmI8kBymAR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZk1qZmFwaVBqOGdFT3hGcHFNUGRVaHdMbTl2NDI3WVM1UHo2aUV3UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6MTIzNC9Mb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1735472756),
('povQdv1pVDWOTBLOe1bpaEEjumgcfKFmUhKSNUZR', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', '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', 1735475555);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `role_type` enum('Admin','Customer','Staff','Seller') NOT NULL,
  `is_verified_account` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `dob`, `is_active`, `role_type`, `is_verified_account`, `password`, `joined_at`, `updated_at`) VALUES
(1, 'Daniel', 'Green', 'daniel@gmail.com', '+44 7990 123456', '1980-02-18', 1, 'Admin', 0, 'e7f84ff145ced31368756c41af7fef9c', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(2, 'John', 'Smith', 'john@gmail.com', '+44 7911 123456', '1985-06-15', 0, 'Staff', 0, '6d40e095b7f43848dc76ec017592da29', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(3, 'Emily', 'Johnson', 'emily@gmail.com', '+44 7911 654321', '1990-11-02', 0, 'Staff', 0, 'f6244d2fc24ec05bedfbf7a84a42ddd4', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(4, 'Michael', 'Williams', 'michael@gmail.com', '+44 7911 234567', '1982-03-25', 0, 'Staff', 0, 'fdec10f5e0fc93e0dadc8c53b9802623', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(5, 'Sarah', 'Brown', 'sarah@gmail.com', '+44 7911 876543', '1987-12-05', 0, 'Staff', 0, '80b801451242d70d4311435fc6abae44', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(6, 'David', 'Taylor', 'david@gmail.com', '+44 7911 987654', '1993-09-18', 0, 'Staff', 0, '889211b122daa7f9f917d3d3b3475514', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(7, 'Oliver', 'Jones', 'oliver@gmail.com', '+44 7420 123456', '1995-01-22', 1, 'Customer', 1, '29dfa8f7d1eae182e8e0cedb69271e58', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(8, 'Sophia', 'Davies', 'sophia@gmail.com', '+44 7420 654321', '1989-04-10', 0, 'Customer', 0, '4d4cc5ce3071ce7dbb117a1e5503a3be', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(9, 'James', 'Miller', 'james@gmail.com', '+44 7420 234567', '1992-07-05', 0, 'Customer', 0, '2ec9246a5c996d9a0004b47ec3dc6a81', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(10, 'Isla', 'Wilson', 'isla@gmail.com', '+44 7420 876543', '1996-02-15', 0, 'Customer', 0, 'f440b71f0d28f65b1ffd25c7ce4f0bd0', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(11, 'Henry', 'Moore', 'henry@gmail.com', '+44 7420 987654', '1990-09-30', 0, 'Customer', 0, 'dce28b80dfad7c6d4138e34e43c85c6a', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(12, 'Charlotte', 'Taylor', 'charlotte@gmail.com', '+44 7733 123456', '1985-06-25', 0, 'Seller', 0, '793c43edeb46ace591b721034962fece', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(13, 'Ethan', 'Anderson', 'ethan@gmail.com', '+44 7733 654321', '1990-08-14', 0, 'Seller', 0, 'f78741b29d51f6fe6de6be317e56851a', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(14, 'Amelia', 'Thomas', 'amelia@gmail.com', '+44 7733 234567', '1993-01-18', 0, 'Seller', 0, 'd3ce548c6d31467b651f4bc8deafb884', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(15, 'Jack', 'Jackson', 'jack@gmail.com', '+44 7733 876543', '1987-11-23', 0, 'Seller', 0, '7000dcb4458a658cd95a871e25c473c9', '2024-12-23 02:34:07', '2024-12-28 12:05:21'),
(16, 'Ava', 'White', 'ava@gmail.com', '+44 7733 987654', '1995-04-07', 0, 'Seller', 0, '10a9a2ec0bb8d7c7e288aed08b06497a', '2024-12-23 02:34:07', '2024-12-28 12:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `gender` enum('Male','Female','Others') NOT NULL,
  `profile_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `gender`, `profile_img`) VALUES
(1, 1, 'Male', 'daniel.jpg'),
(2, 2, 'Male', 'john.jpg'),
(3, 3, 'Female', 'emily.jpg'),
(4, 4, 'Male', 'michael.jpg'),
(5, 5, 'Female', 'sarah.jpg'),
(6, 6, 'Male', 'david.jpg'),
(7, 7, 'Male', 'oliver.jpg'),
(8, 8, 'Female', 'sophia.jpg'),
(9, 9, 'Male', 'james.jpg'),
(10, 10, 'Female', 'isla.jpg'),
(11, 11, 'Male', 'henry.jpg'),
(12, 12, 'Female', 'charlotte.jpg'),
(13, 13, 'Male', 'ethan.jpg'),
(14, 14, 'Female', 'amelia.jpg'),
(15, 15, 'Male', 'jack.jpg'),
(16, 16, 'Female', 'ava.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `baskets`
--
ALTER TABLE `baskets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `baskets_product_id_foreign` (`product_id`),
  ADD KEY `baskets_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_order_id_index` (`order_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loyalty_points`
--
ALTER TABLE `loyalty_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loyalty_points_purchase_id_foreign` (`purchase_id`),
  ADD KEY `loyalty_points_customer_id_index` (`customer_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_index` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_order_id_index` (`order_id`);

--
-- Indexes for table `order_returns`
--
ALTER TABLE `order_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_returns_order_id_index` (`order_id`),
  ADD KEY `order_returns_order_item_id_index` (`order_item_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_index` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_index` (`category_id`);

--
-- Indexes for table `products_inventory`
--
ALTER TABLE `products_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_inventory_product_id_foreign` (`product_id`),
  ADD KEY `products_inventory_last_updated_by_foreign` (`last_updated_by`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `referrals_referral_code_unique` (`referral_code`),
  ADD KEY `referrals_referred_by_index` (`referred_by`),
  ADD KEY `referrals_referred_to_index` (`referred_to`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_email_index` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_index` (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_product_id_foreign` (`product_id`),
  ADD KEY `wishlist_customer_id_index` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `baskets`
--
ALTER TABLE `baskets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loyalty_points`
--
ALTER TABLE `loyalty_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_returns`
--
ALTER TABLE `order_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `products_inventory`
--
ALTER TABLE `products_inventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `baskets`
--
ALTER TABLE `baskets`
  ADD CONSTRAINT `baskets_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `baskets_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loyalty_points`
--
ALTER TABLE `loyalty_points`
  ADD CONSTRAINT `loyalty_points_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loyalty_points_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_returns`
--
ALTER TABLE `order_returns`
  ADD CONSTRAINT `order_returns_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_returns_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products_inventory`
--
ALTER TABLE `products_inventory`
  ADD CONSTRAINT `products_inventory_last_updated_by_foreign` FOREIGN KEY (`last_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_inventory_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_referred_by_foreign` FOREIGN KEY (`referred_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `referrals_referred_to_foreign` FOREIGN KEY (`referred_to`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
