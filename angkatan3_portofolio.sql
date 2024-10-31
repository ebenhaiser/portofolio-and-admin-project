-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 02:43 AM
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
-- Database: `angkatan3_portofolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `portofolio_about`
--

CREATE TABLE `portofolio_about` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `cv` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portofolio_about`
--

INSERT INTO `portofolio_about` (`id`, `userId`, `name`, `summary`, `cv`, `picture`) VALUES
(1, 1, 'Ebenhaiser', 'I graduated with a Master of Computer Science from Bina Nusantara University, Indonesia. I pursued a bachelor’s degree in computer science starting in 2019 and subsequently participated in the Bina Nusantara University Master Track program to obtain my master\'s degree. My research interests include text classification, emotion detection, and text mining. Additionally, I am passionate about Designing UI and Editing.', '', 'aboutPicture1.jpg'),
(3, 2, 'Kakek Sugiono', 'Saya sehat, kuat, dan tahan lama', '', 'aboutPicture2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio_certificate`
--

CREATE TABLE `portofolio_certificate` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `certificate_sequence` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `credential` varchar(255) NOT NULL,
  `issue_date` varchar(255) NOT NULL,
  `exp_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portofolio_certificate`
--

INSERT INTO `portofolio_certificate` (`id`, `userId`, `certificate_sequence`, `name`, `credential`, `issue_date`, `exp_date`) VALUES
(1, 2, 1, 'Jago Pelihara dan Elus Burung', '', '2013', '2015'),
(2, 1, 1, 'ACA Cloud Computing Certification', 'Credential ID IACA01230800098425L', 'Aug. 2023', 'Aug. 2025'),
(3, 1, 2, ' Certificate of Acknowledgement as Author (BEEI)', '', 'Apr. 2024', '');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio_education`
--

CREATE TABLE `portofolio_education` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `education_sequence` int(11) NOT NULL,
  `school` varchar(255) NOT NULL,
  `major` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `start_year` varchar(255) NOT NULL,
  `end_year` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portofolio_education`
--

INSERT INTO `portofolio_education` (`id`, `userId`, `education_sequence`, `school`, `major`, `summary`, `start_year`, `end_year`) VALUES
(1, 1, 2, 'Binus University', 'Master of Computer Science', 'I graduated with a master degree in computer science focusing on Artificial Intelligence, Advanced Database, and IT Management. My studies equipped me with in-depth knowledge and practical skills these areas, preparing me for advanced roles in the tech industry.', '2022', '2024'),
(2, 1, 1, 'Binus University', 'Bachelor of Computer Science', 'Acquired a Bachelor of Computer Science from Bina Nusantara University prior to which important grounding in areas such as programming, algorithms, software and database was done.', '2019', '2023'),
(3, 2, 3, 'UPIL (Universitas Peternakan Ikan Lele)', 'Sarjana Senam Pinggul', 'Saya jago senam pinggul setelah lulus', '2000', '2004'),
(4, 2, 2, 'UPIL (Universitas Peternakan Ikan Lele)', 'Magister Gaya Bebas', 'Setelah saya ke klinik tongfang, saya jadi bisa gaya bebas ', '2008', '2012'),
(5, 2, 1, 'UPIL (Universitas Peternakan Ikan Lele)', 'Doktor Kecing Berdiri', 'Saya jago aja', '2020', '2050');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio_hero`
--

CREATE TABLE `portofolio_hero` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portofolio_hero`
--

INSERT INTO `portofolio_hero` (`id`, `userId`, `title`, `subtitle`, `banner`) VALUES
(1, 1, 'Ebenhaiser Jonathan Caprisiano', 'I am a Master of Computer Science Graduate', 'heroBanner1.jpg'),
(5, 2, 'Kakek Sugiono', 'Saya adalah seorang mentor yang handal', 'heroBanner2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio_message`
--

CREATE TABLE `portofolio_message` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `message` text NOT NULL,
  `sent_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portofolio_message`
--

INSERT INTO `portofolio_message` (`id`, `userId`, `status_id`, `name`, `email`, `phone`, `message`, `sent_date`) VALUES
(6, 2, 2, 'Gus Syamss', '', '', 'Lu orangnya asik bang', '2024-10-30 01:18:01');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio_message_read_status`
--

CREATE TABLE `portofolio_message_read_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portofolio_message_read_status`
--

INSERT INTO `portofolio_message_read_status` (`id`, `status_name`) VALUES
(1, 'Read'),
(2, 'Unread');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio_project`
--

CREATE TABLE `portofolio_project` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `project_sequence` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `client` varchar(50) DEFAULT NULL,
  `start_date` varchar(50) DEFAULT NULL,
  `end_date` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portofolio_project`
--

INSERT INTO `portofolio_project` (`id`, `userId`, `project_sequence`, `title`, `picture`, `category`, `client`, `start_date`, `end_date`, `url`, `description`) VALUES
(1, 2, 1, 'Membuat tutorial bikin bayi mainan', 'projectPicture1.jpeg', 'Biologi', 'Pribadi', 'Jan. 2021', 'Feb. 2021', '', ''),
(2, 1, 1, 'NikkoClass', 'projectPicture2.png', 'Web Design', 'Binus University', 'Feb. 2021', '', '', 'In this project, me and my team created NikkoClass, an online application designed to support and help users in learning about filmmaking for individuals interested in film production. The software attempts to teach users how to make films and how production companies work. Users can attend classes customized to the positions they want to pursue in film production. In this project, I served as UI designer, creating a basic and easy-to-understand interface for people of all backgrounds. This online application is also designed to be easily accessible across a variety of platforms and devices.'),
(3, 1, 2, 'TicketsID', 'projectPicture3.jpg', 'Web Design', 'Binus University', 'Sep. 2022', '', '', 'In this project, I worked as a UI designer to create a mobile application called TicketsID, which allows users to book cinema tickets online while also providing information about movie highlights and news. My main goal was to create a straightforward and beautiful interface that provides a smooth and efficient user experience across all mobile operating systems. The goal is to produce a responsive and user-friendly UI design that fits the needs of the users.'),
(4, 1, 3, 'Quick Task', 'projectPicture4.png', 'Web Design', 'Binus University', 'Jul. 2023', '', '', 'We developed a simple web-based application to help users manage and monitor their daily tasks and activities. The application allows users to save tasks, categorized into three priority levels with due dates set by the user. This web-based application was built using the PHP framework Laravel.\r\n\r\n'),
(5, 1, 4, 'Hybrid Word Embedding', 'projectPicture5.png', 'Natural Language Processing', 'Binus University', 'Dec. 2023', 'Jan.2024', 'https://github.com/ebenhaiser/Enhancing-Offensive-Text-Classification-from-Social-Media-Using-Ensemble-Embedding-Approach', 'I developed a natural language processing program aimed at text classification, specifically targeting the identification of offensive content in social media. The program implements a hybrid embedding model that combines FastText and TF-IDF techniques to enhance accuracy. Using Python and TensorFlow Keras, I built and trained the model, resulting in improved F1 Macro scores across three datasets. This achievement was made possible by leveraging the advantages of the hybrid embedding approach.\r\n\r\n'),
(6, 1, 5, 'Tumpang Sari Doa', 'projectPicture6.png', 'Web Design', 'Tumpang Sari Doa', 'Jun. 2024', '', 'https://github.com/ebenhaiser/tumpangsari.github.io', 'In this project, I was assigned to be a frontend developer tasked with creating a website for Tumpang Sari Doa accommodations. The goal is to enhance the marketing efforts of this accommodation business by providing comprehensive information about the property. The website is designed to be user-friendly across various platforms, including computers and smartphones.'),
(7, 2, 2, 'Main  lato lato', 'projectPicture7.jpeg', 'aselole', 'ada lahh', 'Dec. 2023', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio_publication`
--

CREATE TABLE `portofolio_publication` (
  `id` int(11) NOT NULL,
  `publication_sequence` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `time_of_publication` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portofolio_publication`
--

INSERT INTO `portofolio_publication` (`id`, `publication_sequence`, `userId`, `title`, `publisher`, `time_of_publication`, `link`) VALUES
(1, 1, 2, 'Cara Menendak Pintu Auto Dibeliin Aerok', 'RizkyPublisher', 'Jan. 2006', ''),
(2, 1, 1, 'Classifying possible hate speech from text with deep learning and ensemble on embedding method', 'Bulletin of Electrical Engineering and Informatics (BEEI)', 'June 2022', 'https://doi.org/10.11591/eei.v13i3.6041');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio_skills`
--

CREATE TABLE `portofolio_skills` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `skill_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portofolio_skills`
--

INSERT INTO `portofolio_skills` (`id`, `userId`, `category_id`, `skill_name`) VALUES
(1, 2, 2, 'Tahan Lama'),
(2, 2, 2, 'Kuat'),
(3, 2, 1, 'Berenang'),
(4, 1, 2, 'Analytical Skills'),
(5, 1, 2, 'Respectfulness'),
(6, 1, 2, 'Respectfulness'),
(7, 1, 2, 'Intercultural Competence'),
(8, 1, 2, 'Persuasion'),
(9, 1, 2, 'Innovation'),
(10, 1, 2, 'Empathy'),
(11, 1, 2, 'Networking'),
(12, 1, 2, 'Decision Making'),
(13, 1, 2, 'Work Ethic'),
(14, 1, 2, 'Creativity'),
(15, 1, 2, 'Critical Thinking'),
(16, 1, 2, 'Adaptability'),
(17, 1, 2, 'Time Management'),
(18, 1, 2, 'Problem-Solving'),
(19, 1, 2, 'Teamwork'),
(20, 1, 1, 'Java'),
(21, 1, 1, 'Adobe Premiere'),
(22, 1, 1, 'Ms Office'),
(23, 1, 1, 'Laravel'),
(24, 1, 1, 'PHP'),
(25, 1, 1, 'SQL'),
(26, 1, 1, 'C++'),
(27, 1, 1, 'Bootstrap'),
(28, 1, 1, 'Python'),
(29, 1, 1, 'JavaScript'),
(30, 1, 1, 'HTML'),
(31, 1, 1, 'CSS'),
(32, 1, 1, 'Figma'),
(33, 1, 1, 'UX Design'),
(34, 1, 1, 'UI Design'),
(35, 1, 1, 'AI'),
(36, 1, 1, 'Deep Learning'),
(37, 1, 1, 'Machine Learning'),
(38, 1, 1, 'Text Mining'),
(39, 1, 1, 'CNN'),
(40, 1, 1, 'RNN'),
(41, 1, 1, 'NLP'),
(42, 2, 2, 'Sehat'),
(43, 2, 1, 'Senam Pinggul'),
(44, 2, 1, 'Gaya Anjing (Berenang)'),
(45, 2, 1, 'Jago Tarung');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio_skills_category`
--

CREATE TABLE `portofolio_skills_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portofolio_skills_category`
--

INSERT INTO `portofolio_skills_category` (`id`, `category_name`) VALUES
(1, 'Hard Skill'),
(2, 'Soft Skill');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio_testimonial`
--

CREATE TABLE `portofolio_testimonial` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `affiliation` varchar(255) DEFAULT NULL,
  `testimony` text NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portofolio_testimonial`
--

INSERT INTO `portofolio_testimonial` (`id`, `userId`, `name`, `affiliation`, `testimony`, `picture`) VALUES
(1, 2, 'Bree', 'Istri Tetangga', 'Walaupun lanjut usia, beliau memiliki tenaga yang kuat', 'testimonialPicture1.jpeg'),
(6, 2, 'Gus Syamss', 'Teman SD', 'Dia orangnya selalu nge-flow ajee', 'testimonialPicture6.jpg'),
(7, 1, 'Ramadhian Eka Putra', 'Binus University', 'Ebenhaiser is a great person in group projects. He is adept in writing research paper and keen to explore new things about computer science mainly in deep learning about text classifications. He also has a very good conversational skills in communicating many university projects.\r\n', 'testimonialPicture7.jpg'),
(8, 1, 'Wishnu Anindito', 'Binus University', 'I had the pleasure of working closely with Ebenhaiser during their time as a master\'s student, and I can confidently say that they are an exceptional individual. Ebenhaiser\'s dedication to their work is truly impressive; they consistently demonstrate a strong work ethic and a willingness to go above and beyond to achieve excellence. One of Ebenhaiser\'s standout qualities is their ability to collaborate effectively with their working partners. They possess excellent communication skills and are always open to feedback and ideas from others. Ebenhaiser\'s collaborative nature not only fosters a positive working environment but also leads to successful outcomes. I have no doubt that Ebenhaiser will continue to thrive in their future endeavors, and I wholeheartedly recommend them for any opportunity they pursue.', 'testimonialPicture8.jpg'),
(9, 1, 'Brilyan Nathanael Rumahorbo', 'Binus University', 'Ebenhaiser is a dependable and proactive individual who consistently completes his college projects on time. He exhibits a strong passion for technology, eagerly embracing new learning opportunities. Additionally, he actively supports his team members in achieving collective goals during group projects. I am delighted to have the opportunity to learn alongside Ebenhaiser and have gained valuable insights from him.', 'testimonialPicture9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio_work_experience`
--

CREATE TABLE `portofolio_work_experience` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `work_sequence` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `summary` text DEFAULT NULL,
  `start_year` varchar(255) NOT NULL,
  `end_year` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portofolio_work_experience`
--

INSERT INTO `portofolio_work_experience` (`id`, `userId`, `work_sequence`, `position`, `company_name`, `summary`, `start_year`, `end_year`) VALUES
(1, 2, 1, 'Actor', 'Movie Studio', 'Saya acting sebagai tokoh utama yang harus menjaga menantu', '2008', '2010'),
(4, 1, 1, 'IT Support Staff - Internship', 'PT. Morita Tjokro Gearindo', 'Provide IT support to ensure office infrastructure meets workplace needs, assisting employees with computer-related issues. Build server hardware to meet business industry demands, including constructing new servers capable of accessing data from damaged database drives. Utilities Microsoft Excel for processing business tax information and managing datasets for business servers.', 'Sept. 2021', 'Aug. 2022');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilePicture` varchar(255) NOT NULL,
  `username_for_index` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profilePicture`, `username_for_index`, `first_name`, `last_name`) VALUES
(1, 'Ebenhaiser', 'ebenhaiser@gmail.com', '12345678', 'profilePicture1.jpg', 'ebenhaiser', 'Ebenhaiser', ''),
(2, 'Kakek Sugiono', 'sugiono@gmail.com', '12345678', 'profilePicture2.jpeg', 'kakekSugiono', 'Kakek', 'Sugiono'),
(4, 'Bang Ganteng', 'ganteng@gmail.com', '12345678', '', 'bangGanteng', 'Bang', 'Ganteng');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `portofolio_about`
--
ALTER TABLE `portofolio_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portofolio_certificate`
--
ALTER TABLE `portofolio_certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portofolio_education`
--
ALTER TABLE `portofolio_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portofolio_hero`
--
ALTER TABLE `portofolio_hero`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portofolio_message`
--
ALTER TABLE `portofolio_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portofolio_project`
--
ALTER TABLE `portofolio_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portofolio_publication`
--
ALTER TABLE `portofolio_publication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portofolio_skills`
--
ALTER TABLE `portofolio_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portofolio_skills_category`
--
ALTER TABLE `portofolio_skills_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portofolio_testimonial`
--
ALTER TABLE `portofolio_testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portofolio_work_experience`
--
ALTER TABLE `portofolio_work_experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `portofolio_about`
--
ALTER TABLE `portofolio_about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `portofolio_certificate`
--
ALTER TABLE `portofolio_certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `portofolio_education`
--
ALTER TABLE `portofolio_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `portofolio_hero`
--
ALTER TABLE `portofolio_hero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `portofolio_message`
--
ALTER TABLE `portofolio_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `portofolio_project`
--
ALTER TABLE `portofolio_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `portofolio_publication`
--
ALTER TABLE `portofolio_publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `portofolio_skills`
--
ALTER TABLE `portofolio_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `portofolio_skills_category`
--
ALTER TABLE `portofolio_skills_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `portofolio_testimonial`
--
ALTER TABLE `portofolio_testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `portofolio_work_experience`
--
ALTER TABLE `portofolio_work_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
