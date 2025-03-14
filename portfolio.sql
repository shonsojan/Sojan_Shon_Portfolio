-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2025 at 07:15 PM
-- Server version: 8.0.41-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `first_name`, `last_name`, `email`, `message`, `submitted_at`) VALUES
(1, 'Omondi', 'Bunde', 'omondiaustinebunde@gmail.com', 'comment here', '2025-03-13 19:13:46'),
(2, 'Omondi', 'Bunde', 'omondiaustinebunde@gmail.com', 'comment here', '2025-03-13 19:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int UNSIGNED NOT NULL,
  `last_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `first_name` varchar(300) NOT NULL,
  `email` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `last_name`, `first_name`, `email`, `message`) VALUES
(1, 'Johnson', 'Alice ', 'alice@example.com', 'What are your services?'),
(2, 'Smith', 'Bob ', 'bob.smith@example.com', 'Can you create an animation for our product launch?'),
(3, 'Rodriguez', 'Carla ', 'carla.rodriguez@example.com', 'Looking for help with graphic design for our marketing campaign.'),
(4, 'Lee	', 'David ', 'davidlee@example.com', 'I’d like to discuss a multimedia presentation for my project.'),
(5, 'Chen', 'Emily ', 'emily.chen@example.com', 'Can you assist with a podcast editing service?'),
(15, 'vsrvsds', 'svsv', 'shondrummer10@gmail.com', 'fcihadfciadhfce'),
(16, 'ee', 'ee', 'shondrummer10@gmail.com', 'comeement here'),
(17, 'ww', 'www', 'comment here', 'shondrummer10@gmail.com'),
(18, 'ww', 'qwerert', 'comment here', 'shondrummer10@gmail.com'),
(19, 'ww', 'qwerert', 'comment here', 'shondrummer10@gmail.com'),
(20, 'ww', 'qwerert', 'comment here', 'shondrummer10@gmail.com'),
(21, 'ww', 'qwerert', 'comment here', 'shondrummer10@gmail.com'),
(22, 'vsrvsds', 'qwerert', 'comment here', 'shondrummer10@gmail.com'),
(23, 'vsrvsds', 'qwerert', 'comment here', 'shondrummer10@gmail.com'),
(24, 'vsrvsds', 'qwerert', 'comment here', 'shondrummer10@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int UNSIGNED NOT NULL,
  `project_id` int UNSIGNED NOT NULL,
  `type` varchar(500) NOT NULL,
  `image1` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image2` varchar(1000) NOT NULL,
  `image3` varchar(1000) NOT NULL,
  `image4` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `project_id`, `type`, `image1`, `image2`, `image3`, `image4`) VALUES
(1, 1, 'image', 'project1.jpg', 'project1.1.jpg', 'project1.2.jpg', 'project1.3.jpg'),
(2, 2, 'image', 'project2.jpg', 'project2.1.jpg', 'project2.2.jpg', 'project2.3.jpg'),
(3, 3, 'image', 'project3.jpg', 'project3.1.jpg', 'project3.2.jpg', 'project3.3.jpg'),
(4, 4, 'image', 'project4.jpg', 'project4.1.jpg', 'project4.2.jpg', 'project4.3.jpg'),
(5, 5, 'image', 'project5.jpg', 'project5.1.png', 'project5.2.png', 'project5.3.png'),
(6, 6, 'image', 'project6.jpg', 'project6.1.png', 'project6.2.png', 'project6.3.png');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `image` varchar(700) NOT NULL,
  `description` varchar(1500) NOT NULL,
  `challenges` varchar(255) DEFAULT NULL,
  `solution` varchar(1500) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `image`, `description`, `challenges`, `solution`, `created_at`, `updated_at`) VALUES
(1, 'Quatro Packaging', 'work1.jpg', 'This project allowed me to merge creativity with practicality, resulting in a packaging design that elevated Quatro\'s brand presence. It honed my skills in balancing design aesthetics with real-world functionality.', 'Designing packaging for Quatro that effectively communicated the product\'s premium quality and functionality while ensuring the design stood out on shelves. Balancing aesthetic appeal with practical considerations like readability, space constraints, and ', 'I created a sleek, modern packaging design that incorporated bold typography, a clean layout, and eco-friendly materials. The design prominently displayed key product information while using color and branding elements to attract attention. I also tested prototypes to ensure the packaging was both visually appealing and functional, meeting consumer expectations and retail requirements.', '2025-03-11 20:59:37', '2025-03-11 20:59:56'),
(2, 'Quatro Website', 'work2.jpg', 'Building the Quatro website strengthened my ability to merge design with functionality, delivering a visually appealing and user-centric platform. This project enhanced my skills in responsive design and performance optimization.', 'Developing the Quatro website required creating a user-friendly interface that effectively showcased the product\'s unique features while ensuring seamless navigation. Balancing aesthetics with responsiveness and performance across devices was a significan', 'I designed a clean, modern interface using a mobile-first approach, ensuring the website was fully responsive and accessible on all devices. To enhance engagement, I implemented interactive elements like hover effects and dynamic content while optimizing the website for faster loading times. Rigorous testing was conducted to ensure a smooth user experience.', '2025-03-11 20:59:37', '2025-03-11 20:59:56'),
(3, 'PHP Dynamic Page', 'work3.jpg', 'This project enhanced my understanding of dynamic web development, database integration, and user-friendly navigation. It demonstrated how to build scalable and efficient systems using PHP.', 'Creating dynamic PHP pages to display employee details required designing a system where data was pulled seamlessly from a database. Ensuring smooth navigation between the home page and detailed pages while managing database queries efficiently was a key ', 'I implemented a dynamic structure using PHP and a MySQL database. The home page listed employee names, and clicking on each name dynamically generated a detailed page using PHP scripts. Data retrieval was optimized with well-structured SQL queries, and the design ensured consistency between pages. Comprehensive testing was performed to ensure functionality and responsiveness.', '2025-03-11 20:59:37', '2025-03-11 20:59:56'),
(4, 'Branding Ceci', 'work4.jpg', 'This project allowed me to combine creativity with strategic thinking to build a strong and consistent brand identity for Ceci. It refined my skills in logo design, branding, and creating comprehensive brand guidelines.', 'Establishing a cohesive visual identity for the Ceci brand required designing a logo and branding elements that were both visually appealing and adaptable across various mediums, including digital platforms, packaging, and marketing materials. Maintaining', 'I developed a detailed brand guideline that included a well-crafted logo and specific instructions on its proper usage. The guidelines featured do\'s and don\'ts for alignment, spacing, and scaling to ensure the logo maintained its integrity in all applications. Additionally, I created a repeating logo pattern to enhance the brand\'s visual identity and tested its adaptability across different mediums.', '2025-03-11 20:59:37', '2025-03-13 17:16:20'),
(5, 'Sports Reel', 'work5.jpg', 'This project enhanced my skills in 3D modeling, rendering, and composition while emphasizing the importance of creating impactful visuals for professional portfolios. It demonstrated my ability to merge technical expertise with creative storytelling.\r\n\r\n', 'Creating a dynamic and visually engaging stadium scene in Cinema 4D required careful design of the environment and accurate placement of team emblems. Achieving realism while optimizing the render for inclusion in a demo reel added complexity to the task.', 'I modeled a detailed stadium environment in Cinema 4D, incorporating realistic textures and lighting to bring the scene to life. The team emblems were carefully designed and positioned to stand out prominently within the setting. After rendering the scene, I integrated the footage seamlessly into my demo reel, ensuring it aligned with the overall aesthetic and flow of my portfolio.\r\n\r\n', '2025-03-11 20:59:37', '2025-03-11 20:59:56'),
(6, 'Zyn Earbuds', 'work6.jpg', 'This project honed my skills in interactive web design and animations while emphasizing attention to detail in showcasing product features. The result was an engaging and professional promotional webpage that effectively highlighted the Zyn earbuds.\r\n\r\n', 'Designing a promotional webpage for the Zyn earbuds required creating an interactive user experience that effectively highlighted the earbuds\' unique features, including their compact design. Balancing interactivity, aesthetics, and functionality while en', 'I developed a visually engaging webpage using HTML, CSS, SASS, JavaScript, and GSAP for animations. The page featured three interactive elements representing the earbuds, with hotspots that revealed detailed information on hover. Additionally, I implemented an X-ray view using a comparison slider to showcase the internal structure. Rigorous testing ensured a smooth user experience and responsiveness across devices.\r\n\r\n', '2025-03-11 20:59:37', '2025-03-11 20:59:56'),
(7, 'Driving School App', 'project_67d1ef26c95cd.png', 'AA is the market leader in Driving School in Kenya. For over 6 decades, we have set industry standards in this area, with an overall objective of inculcating a safe motoring culture across the country. AA Driving School is recognised by Government, International Organisations and Corporate Private Sector.\r\nAA trains drivers for the following categories;', '<br />\r\n<b>Deprecated</b>:  htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in <b>/var/www/html/sojan_portfolio/admin/edit_project_form.php</b> on line <b>97</b><br />', 'In chemistry, a solution is defined by IUPAC as \"A liquid or solid phase containing more than one substance, when for convenience one substance, which is called the solvent, is treated differently from the other substances, which are called solutes. Wi', '2025-03-11 22:44:45', '2025-03-12 20:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `project_technology`
--

CREATE TABLE `project_technology` (
  `id` int UNSIGNED NOT NULL,
  `project_id` int UNSIGNED NOT NULL,
  `technology_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_technology`
--

INSERT INTO `project_technology` (`id`, `project_id`, `technology_id`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 2),
(4, 4, 1),
(5, 5, 2),
(6, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` smallint UNSIGNED NOT NULL,
  `user_lname` varchar(35) NOT NULL,
  `user_fname` varchar(35) NOT NULL,
  `user_city` varchar(30) NOT NULL,
  `user_email` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_lname`, `user_fname`, `user_city`, `user_email`) VALUES
(2, 'Lapin', 'Louise', 'London', 'yesthisisfake@gmail.com'),
(5, 'Burgandy', 'Ron', 'London', 'ron@gmail.com'),
(9, 'Bunde', 'Omondi', 'Migori', 'omondiaustinebunde@gmail.com'),
(10, 'Bunde', 'Omondi', 'Migori', 'omondiaustinebunde@gmail.com'),
(11, 'Bunde', 'Omondi', 'Migori', 'omondiaustinebunde@gmail.com'),
(13, 'Bunde', 'Omondi', 'Migori', 'omondibunde32@gmail.com'),
(14, 'Bunde', 'Austine', 'Nairobi', 'omondibunde32@gmail.com'),
(15, 'Bunde', 'Austine', 'Nairobi', 'omondibunde32@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `technology`
--

CREATE TABLE `technology` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `technology`
--

INSERT INTO `technology` (`id`, `name`) VALUES
(1, 'HTML, CSS, JavaScript'),
(2, 'Photoshop, Illustrator, XD'),
(3, 'HTML, CSS, Javascript, Photoshop, XD');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','user','manager') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `full_name`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'shon', '', NULL, 'shon1234', 'user', 'active', '2025-03-11 19:51:23', '2025-03-11 19:51:23'),
(2, 'shon', 'shon@gmail.com', 'Shon Sojan', '$2y$10$4/U.iYQgxNBw8XHuvhE7iOiGdYomImycRu88YY0nCSo5JbBQcYs1S', 'admin', 'active', '2025-03-11 20:43:36', '2025-03-11 20:43:36'),
(4, 'shon', 'shon1@gmail.com', 'Shon Sojan', '$2y$10$SKSL05e2Gs9iqF9xDZfijOP3rh/EkgK5IBHEVsfjzCFSRtqP54RTi', 'admin', 'active', '2025-03-11 20:45:32', '2025-03-11 20:45:32'),
(5, 'kk', 'kkk@gmail.com', 'aa', '$2y$10$UdHkgusAzcASniirWgZnPOFPDfY1f6afME0a6Xv3tmPEVRczVXVca', 'admin', 'active', '2025-03-11 23:09:43', '2025-03-11 23:10:00'),
(6, '112', 'omondiaustinebunde@gmail.com', 'Austine Bunde', '$2y$10$kKLkm5C48o/SrYMtBPhk1.gAkWma8Nsc7IimOe6ch4shOSC88twre', 'admin', 'active', '2025-03-11 23:10:37', '2025-03-11 23:10:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_technology`
--
ALTER TABLE `project_technology`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `technology`
--
ALTER TABLE `technology`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_technology`
--
ALTER TABLE `project_technology`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` smallint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `technology`
--
ALTER TABLE `technology`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
