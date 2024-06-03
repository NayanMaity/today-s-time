-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 01:42 PM
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
-- Database: `today's_time_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `notification_title` varchar(255) NOT NULL DEFAULT 'Become Blogger',
  `notification_status` enum('pending','approve','reject') NOT NULL DEFAULT 'pending',
  `user_id` int(11) NOT NULL,
  `create_notification_data` varchar(255) DEFAULT NULL,
  `update_notification_data` varchar(255) DEFAULT NULL,
  `notification_show` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `notification_title`, `notification_status`, `user_id`, `create_notification_data`, `update_notification_data`, `notification_show`) VALUES
(1, 'Become Blogger', 'reject', 2, '24-04-12 11:41:39', '24-04-12 18:26:44', '1');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_desc` text NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_post_data` varchar(255) DEFAULT NULL,
  `update_post_data` varchar(255) DEFAULT NULL,
  `post_show` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_title`, `post_desc`, `post_image`, `category_id`, `user_id`, `create_post_data`, `update_post_data`, `post_show`) VALUES
(1, 'Unlocking the Potential of Quantum Computing: A Leap into the Future', 'In the ever-evolving landscape of technology, quantum computing stands as a beacon of unprecedented potential, promising to revolutionize the way we process information and solve complex problems. Unlike classical computers that rely on binary bits, which represent either a 0 or a 1, quantum computers utilize quantum bits or qubits, which can exist in multiple states simultaneously due to the principles of superposition and entanglement.\r\n\r\nOne of the most captivating aspects of quantum computing is its ability to tackle problems that are practically insurmountable for classical computers. Tasks such as factoring large numbers, optimizing complex systems, simulating quantum phenomena, and encrypting data with unbreakable security become within reach with the computational power of quantum computers.', '1712814920_3_blog_Admin_tech_2.jpeg', 3, 3, '2024-04-10 20:14:12', '24-04-12 19:09:12', '1'),
(2, 'Instant ragi dosa', 'In the realm of quick and nutritious breakfast options, few dishes can rival the charm of an instant ragi dosa. Ragi, also known as finger millet, is a powerhouse of nutrients, packed with calcium, iron, and dietary fiber. The dosa, a staple in South Indian cuisine, undergoes a delightful makeover with the incorporation of this wholesome ingredient. Here&#039;s how you can whip up this delectable dish in no time:\r\n\r\nIngredients:\r\n- 1 cup ragi flour\r\n- 1/4 cup rice flour\r\n- 1/4 cup semolina (sooji)\r\n- 1/2 cup yogurt\r\n- 1 finely chopped onion\r\n- 1 finely chopped green chili\r\n- 2 tablespoons chopped coriander leaves\r\n- Salt to taste\r\n- Water as needed\r\n- Oil or ghee for cooking\r\n\r\nInstructions:\r\n1. In a mixing bowl, combine ragi flour, rice flour, semolina, yogurt, chopped onion, green chili, coriander leaves, and salt.\r\n2. Gradually add water to form a smooth batter with a pouring consistency. Let it rest for 10-15 minutes.\r\n3. Heat a non-stick skillet or dosa tawa over medium heat. Lightly grease it with oil or ghee.\r\n4. Pour a ladleful of batter onto the skillet and spread it evenly to form a thin dosa.\r\n5. Drizzle oil or ghee around the edges and cook until the underside turns golden brown and crisp.\r\n6. Flip the dosa and cook the other side for a minute or until it&#039;s cooked through.\r\n7. Repeat the process with the remaining batter.\r\n8. Serve hot with coconut chutney or sambar.', '1712816931_1_blog_Admin_food_1.jpg', 1, 3, '24-04-11 08:28:51', '24-04-11 08:28:51', '1'),
(6, 'Jeremy Finlayson’s AFL ban could herald new era for footy after years of inaction', 'If a footballer or broadcaster said that now you’d like to think they’d be run out of town. But back then it barely raised an eyebrow. It was certainly no impediment to career progression. Such ripping repertoire was in the news this week, after Jeremy Finlayson was eventually suspended for a homophobic slur. It took five days to decide on his penalty. The sticking point was the precedent set by Alastair Clarkson’s slap on the wrist earlier in the year. In effect the AFL conceded that it had been too lenient with the North Melbourne coach and that this was its stake in the ground.\r\n\r\nThe issue of homophobia and footballers was covered in depth by the ABC investigative journalist Louise Milligan on Four Corners last year. At times it was drowning in cliche: “the AFL’s last great taboo”, “the silence is palpable”. It included a completely nonsensical contribution from Jason Akermanis. But there were also some thoughtful interviews and it was a long-overdue look at an issue the footy media has largely been reluctant to tackle.', '1712856947_4_blog_Nayan Maity_sport_1.jpg', 4, 6, '24-04-11 23:05:47', '24-04-11 23:05:47', '1'),
(7, 'Seeing with “fresh eyes” – A deeper nature experience', 'Around the time I first learned how to meditate, something amazing happened to me. It happened one day, quite spontaneously. \r\n\r\nI was working as a lawyer at the time and I used to walk down a little lane way to the train station on my commute to work. It’s not an especially beautiful lane way – a concrete footpath, metal gates on one side and some shrubs and bushes on the other side. I must have walked this exact same route a thousand times before.\r\n\r\nExcept today it was different.\r\n\r\nI couldn’t explain it but it was as if I was seeing this place for the very first time. I saw bees moving frantically amongst the flowers. The colours were so incredibly vivid. Were these same flowers here yesterday? Had someone come in the middle of the night and changed everything? It felt like that. There were so many details I had never seen before. It was disconcerting and in a way, almost frightening. I was usually a very brisk, purposeful walker but now my pace slowed. I looked around. There was so much life. So much movement. I felt an emotion that wasn’t at all familiar to me in those days…. pure joy. I could feel it intensely in my body. I just wanted to bask in all this beauty. I had been asleep, dead and now, finally I was awake.\r\n\r\nIt’s not an uncommon experience when someone starts to practice mediation. As we start to slow down and stop living so much in our heads, we can experience a shift in perspective. Sometimes it is more gradual and subtle, but in my case it was quite sudden and dramatic.', '1712857078_5_blog_Nayan Maity_nature_1.jpg', 5, 6, '24-04-11 23:07:58', '24-04-11 23:07:58', '1'),
(8, 'Meet the Bhutanese Blogger and Solo Traveller Unearthing Bhutan’s Best Kept Secrets.', 'I was in awe of Tshering Denkar even before I met her.\r\n\r\nI first read her travel blog – Denkar’s Getaway – after receiving an invitation to share the stage with her at the Mountain Echoes Literary Festival in Bhutan. She had spent the past couple of years travelling solo across the length and breath of her own country. Hiking, hitch-hiking and living with indigenous communities in remote mountain hamlets!\r\n\r\nTravelling is never about the labels. But being Bhutan’s first solo female traveller and the first Bhutanese blogger in the travel space is a pretty big deal.\r\n\r\nI mean, scan through global travel writing archives – or even articles about travelling in Bhutan – and tell me how many voices of intrepid female South Asian travellers can you find?\r\n\r\nIn Thimphu, I finally met Denkar – full of energy, excitement and humor – and despite being an introvert myself, we immediately connected through our mutual love for the road. Her travel stories eventually led us to Haa Valley and plans to explore the remote eastern provinces someday.\r\n\r\nWhile hiking with Denkar in the mountains of Thimphu, I learnt how the King of Bhutan reads her travel blog and even invited her to meet him! He encouraged her to keep exploring the wonders of Bhutan, and inspire more Bhutanese people to explore their own country.', '1712857229_2_blog_Nayan Maity_travel_1.jpg', 2, 6, '24-04-11 23:10:29', '24-04-11 23:10:29', '1'),
(9, 'A Breakdown of the Full English Breakfast', 'Bacon, sausages, eggs, tomatoes, mushrooms, toast, and beans all on one plate: is a Full English breakfast the most ultimate breakfast ever?\r\n\r\nConfession: I’ve never had a real full English. At least not in England or anywhere in world in fact, except right here, at home. But a couple of weeks ago, Mike and I were chatting with a dude that moved here from England and the thing he said he missed the most was breakfast, specifically a Full English breakfast. He waxed poetic about the deliciousness for a good five minutes, but I wasn’t sold. Mike was nodding along, agreeing with him because he’s eaten many a full English in London, but me? Nope.\r\n\r\nI really wasn’t interested until Mike showed me a photo a couple days later. It was a giant plate and it looked AMAZING. I mean, it might have been because I was very hungry, but at the time, nothing looked better to my eyes. Thus started the Full English Obsession. Mike and I took a casual look around town to see what ingredients we could find and here’s what we came up with!\r\n\r\nWhat is a full English breakfast?\r\nSometimes called a fry up, a full English is a hearty, hefty breakfast plate served in the UK and Ireland. Full English breakfasts are so popular that they’re pretty much offered throughout the day as all-day breakfast. Full English breakfasts contain: sausages, back bacon, eggs, tomatoes, mushrooms, fried bread, and beans.', '1712933348_1_blog_Rahul_food_2.jpg', 1, 2, '24-04-12 20:19:08', '24-04-12 20:19:08', '1'),
(10, 'Dante Exum comes of age in NBA to boost Boomers ahead of Paris Olympics', 'The Australian playmaker’s luck appears to have finally turned as he solidifies his status among the world’s best basketballers.\r\n\r\nIt’s taken him a decade, but Dante Exum has finally made it in the NBA, and it comes at the perfect time for Australia’s Boomers.\r\n\r\nThe imposing perimeter defence has helped. So too the smooth playmaking as the anchor for the bench of the fast rising Dallas Mavericks. Hitting 50% from the three-point line certainly doesn’t hurt.\r\n\r\nBut the moment that solidified the 28-year-old’s status among the world’s best basketball players came in Sunday’s match against the Houston Rockets.\r\n\r\nExum had the game in his hands with just two seconds left. The Mavs were down by three against their Texas rivals. As the clock wound down, the backup guard wearing the number zero had been found with a pass from Dallas’ best player, Luka Dončić, under pressure from swarming Rockets defenders.\r\n\r\nFrom the right side of the court, just outside the three-point line, the Australian looked up and swiftly released. The clock faded to one, then zero. The buzzer sounded, and the net billowed. Exum – by way of Melbourne, Utah, Cleveland, Spain and Serbia – had arrived.\r\n\r\nAfter the 147-136 overtime victory, Kyrie Irving gathered the players and owner Mark Cuban into the middle of the court to celebrate the victory, but moreso their longsuffering Australian whose luck appears to have finally turned.', '1712935061_4_blog_Admin_sport_3.jpg', 4, 3, '24-04-12 20:47:41', '24-04-12 20:47:41', '1'),
(11, 'Talking Horses: Mahler Mission best value in gruelling Grand National', 'The more pessimistic forecasts for rainfall at Aintree this week failed to materialise but the going for Saturday’s race will still be the most gruelling for 23 years and only thorough stayers should be considered for inclusion on backers’ shortlists.\r\n\r\nIn that respect, the betting market has already done a lot of the legwork, as all but a couple of the runners priced up at 33-1 or below have stamina as one of their strongest suits. Narrowing them down to three or four prime candidates is much more problematic, though, and ultimately depends on an individual punter’s idea of what might be required.\r\n\r\nLucinda Russell has pulled off the remarkable trick of getting Corach Rambler to Aintree as arguably the best-handicapped horse in the race for the second year in a row, and his course form makes him more appealing than I Am Maximus or Meetingofthewaters at a similar sort of price.\r\n\r\n\r\nBut ultimately his chance is little better than that of runners at twice the odds, and rivals too like Panda Boy that have crept in at the bottom of the weights.\r\n\r\nIn truth, there is little juice left in most of the leading contenders’ prices, but a possible exception is the 16-1 about Mahler Mission (4.00), who has been kept fresh since November with only the National in mind.\r\n\r\nJohn McConnell, his trainer, is also a little under-the-radar in Britain, but he has an outstanding record with his runners in this country and his first Grand National contender has a near-perfect profile for the race in terms of his age, talent, stamina and form to date.\r\n\r\nAintree 1.20 Nicky Henderson’s string is still operating some way below its normal high level, but Bold Endeavour put up the best performance of any the trainer’s 16 runners at last month’s Cheltenham Festival when he finished fourth in the Pertemps Final. If he could build on that career-best, the eight-year-old’s early price of around 25-1 could be an each-way snip.', '1712935132_4_blog_Admin_sport_2.jpg', 4, 3, '24-04-12 20:48:52', '24-04-12 20:48:52', '1');

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_desc` varchar(255) NOT NULL,
  `create_category_data` varchar(255) DEFAULT NULL,
  `update_category_data` varchar(255) DEFAULT NULL,
  `category_show` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`category_id`, `category_name`, `category_desc`, `create_category_data`, `update_category_data`, `category_show`) VALUES
(1, 'Food', 'Savor the flavors! Our food blog tantalizes taste buds with culinary adventures. From street food secrets to gourmet delights, join us on a gastronomic journey. Recipes, restaurant reviews, and mouthwatering photos await. Bon appétit!', '2024-04-09 20:50:40', '2024-04-09 21:30:20', '1'),
(2, 'Travel', 'Embark on a journey through hidden gems, vibrant cultures, and breathtaking landscapes. Our travel blog brings you wanderlust-inducing tales, practical tips, and unforgettable experiences. From serene beaches to bustling markets, let us be your compass in', '2024-04-09 21:08:54', '2024-04-09 21:08:54', '1'),
(3, 'Tech', 'Dive into the digital universe! Our tech blog deciphers complex algorithms, reviews cutting-edge gadgets, and explores AI’s frontiers. From coding tips to cybersecurity sagas, join us on this byte-sized adventure.', '2024-04-09 21:10:04', '2024-04-09 21:10:04', '1'),
(4, 'Sport', 'Dive into the heart-pounding world of sports! Our blog celebrates athletic triumphs, profiles legendary athletes, and delves into game strategies. From courts to stadiums, join us as we score insights and celebrate the spirit of competition.', '2024-04-09 21:14:18', '2024-04-09 21:14:18', '1'),
(5, 'Nature', ' Immerse yourself in the wonders of the natural world! Our blog explores lush forests, serene lakes, and rugged mountains. From wildlife encounters to eco-travel tips, join us on a journey of discovery. Let’s celebrate Earth’s beauty and protect its fragi', '2024-04-09 21:14:50', '2024-04-09 21:14:50', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `user_role` enum('admin','user','blogger') NOT NULL DEFAULT 'user',
  `token` int(11) DEFAULT NULL,
  `create_user_data` varchar(255) DEFAULT NULL,
  `update_user_data` varchar(255) DEFAULT NULL,
  `user_show` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `avatar`, `user_role`, `token`, `create_user_data`, `update_user_data`, `user_show`) VALUES
(1, 'Demo', 'demo@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1712595968_Demo_slider-2.jpg', 'user', NULL, '2024-04-08 19:06:08', '2024-04-08 19:06:08', '1'),
(2, 'Rahul', 'rahul@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1712656889_Rahul_avatar_7.png', 'blogger', NULL, '2024-04-08 20:02:16', '24-04-12 13:46:38', '1'),
(3, 'Admin', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1712657005_Admin_avatar_9.png', 'admin', NULL, '2024-04-08 20:49:22', '2024-04-09 12:03:25', '1'),
(4, 'Robi', 'robi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1712682286_Robi_avatar_11.png', 'user', NULL, '2024-04-09 19:04:46', '2024-04-09 19:04:46', '1'),
(5, 'Amit', 'amit@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1712683312_Amit_avatar_12.png', 'blogger', NULL, '2024-04-09 19:21:52', '2024-04-09 20:24:26', '1'),
(6, 'Nayan Maity', 'nayanmaity369@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1712856547_Nayan_Maity_avatar_3.png', 'admin', NULL, '24-04-11 09:53:39', '24-04-11 22:59:07', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'blogger');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `notification_user_relation` (`user_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_user_relation` (`user_id`),
  ADD KEY `post_category_relation` (`category_id`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_user_relation` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_category_relation` FOREIGN KEY (`category_id`) REFERENCES `post_category` (`category_id`),
  ADD CONSTRAINT `post_user_relation` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
