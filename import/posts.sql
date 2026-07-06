-- SQL Database Initialization Script
-- Target Database: `seourl`

CREATE DATABASE IF NOT EXISTS `seourl` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `seourl`;

-- --------------------------------------------------------

-- Table structure for table `posts`
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postname` varchar(50) NOT NULL,
  `postdesc` varchar(100) NOT NULL,
  `postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Dumping data for table `posts`
-- Note: Replaced IDs will auto-increment.
INSERT INTO `posts` (`id`, `postname`, `postdesc`, `postdate`) VALUES
(1, 'Github Tolgahan Acar', 'Github Tolgahan Acar profile and repositories', '2021-05-29 10:51:20'),
(2, 'tolgahanacar.net', 'Go to tolgahanacar.net personal blog', '2021-05-29 10:51:35'),
(3, 'Türkçe Karakter Test Başlığı', 'Örnek açıklama: Şen şakrak, ılık, çelimsiz ve özgün Türkçe başlık örneği.', '2026-07-06 12:28:00');
