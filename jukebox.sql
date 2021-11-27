-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 27 Νοε 2021 στις 17:12:39
-- Έκδοση διακομιστή: 10.4.21-MariaDB
-- Έκδοση PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `jukebox`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `concerts`
--

CREATE TABLE `concerts` (
  `id` bigint(20) NOT NULL,
  `title` varchar(120) NOT NULL,
  `date` date NOT NULL,
  `artistname` varchar(200) NOT NULL,
  `category` varchar(120) NOT NULL,
  `organizer` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `concerts`
--

INSERT INTO `concerts` (`id`, `title`, `date`, `artistname`, `category`, `organizer`) VALUES
(2, 'EJECT Music Festival 2022', '2022-06-29', 'MUSE, NOTHING BUT THIEVES and more', 'Rock, Alternative', 206),
(3, 'Marinella & Marios Frangoulis | Christmas 2021', '2021-12-30', 'Marinella, Marios Frangoulis', 'Musical, Performance', 213),
(4, 'Mozart Orchestra of Vienna - Vienna Waltzes', '2022-01-02', 'Mozart Orchestra of Vienna', 'Classical', 210),
(5, 'Miltos Pashalidis | Stavros tou Notou', '2022-01-30', 'Miltos Pashalidis, Mirella Pahou', 'Alternative, Entechno', 209),
(6, 'GORAN BREGOVIC - Christmas in the Balkans', '2021-12-19', 'Goran Bregovic', 'Balkan, Christmas', 210),
(7, 'SOKRATIS MALAMAS - AKTI PIRAIOS', '2021-11-27', 'Sokratis Malamas', 'Alternative, Entechno', 206),
(8, 'Protopsalti - Chatziyiannis at Christmas Theater', '2021-11-19', 'Alkistis Protopsalti, Michalis Chatziyiannis', 'Pop, Alternative', 210),
(9, 'Ntalaras, Mastoras, Rizou - Athens Lives', '2021-12-13', 'Giorgos Ntalaras, Mariza Rizou, Christos Mastoras', 'Alternative, Pop, Entechno', 209),
(10, 'CELINE DION: Courage World Tour', '2022-06-09', 'Celine Dion', 'Pop, Rock', 213),
(11, 'Release Athens 2020', '2022-06-18', 'Parov Stellar', 'Pop, Rock', 206),
(12, 'Evanescence - Athens 2022', '2022-06-05', 'Evanescence', 'Rock, Pop', 210),
(13, 'Maluma Live in Athens\r\n', '2022-03-02', 'Maluma', 'Pop', 210),
(14, 'Giorgos Ntalaras - Miltos Pashalidis', '2021-12-10', 'Giorgos Ntalaras, Miltos Pashalidis', 'Alternative, Entechno', 209),
(15, 'Afieroma: Loukianos Kilaidonis', '2021-12-21', 'Spyros Grammenos, Foivos Delivorias, Kostis Maravegias', 'Alternative, Folk, Entechno', 206),
(16, 'FRANK SINATRA and Friends', '2021-12-26', 'West End Cast', 'Vintage, Easy-Listening', 210),
(61, 'Hello My Love', '2021-11-10', 'U2', 'Pop, Rock', 210),
(64, 'Pavarotti: A Miracle', '2021-12-28', 'Andrea Bocelli', 'Classical, Opera', 210),
(65, 'Hello', '2021-11-23', '123', 'Pop', 205),
(66, '123', '2021-11-29', '1234', 'Pop', 205);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `concert_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `concert_id`) VALUES
(2052, 205, 2),
(2054, 205, 4),
(2057, 205, 7),
(2058, 205, 8),
(20512, 205, 12),
(20514, 205, 14),
(20516, 205, 16),
(20564, 205, 64),
(2084, 208, 4),
(2087, 208, 7),
(2089, 208, 9),
(2152, 215, 2),
(2157, 215, 7),
(21510, 215, 10);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` varchar(40) NOT NULL,
  `role` enum('ADMIN','ORGANIZER','USER') NOT NULL,
  `confirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `username`, `password`, `email`, `role`, `confirmed`) VALUES
(1, 'Dimitrios', 'Petrou', 'dpetrou', '1234', 'dpetrou@isc.tuc.gr', 'ADMIN', 1),
(205, 'Yannis', 'Vasileiou', 'yvasileiou', '1234', 'johnvasileiou@outlook.us', 'USER', 1),
(206, 'Henry', 'Smith', 'hsmith', '1234', 'hsmith@gmail.com', 'ORGANIZER', 1),
(207, 'Jameson', 'Kearns', 'jkearns', '1234', 'jkearns@gmail.com', 'USER', 0),
(208, 'Leonidas', 'Oneillo', 'loneill', '1234', 'loneill@gmail.com', 'USER', 1),
(209, 'Evelina', 'Saunders', 'esaunders', '1234', 'esaunders@gmail.com', 'ORGANIZER', 1),
(210, 'Lily', 'Anthony', 'lanthony', '1234', 'lanthony@gmail.com', 'ORGANIZER', 1),
(211, 'Paula', 'Macdonald', 'pmacdonald', '1234', 'pmacdonald@gmail.com', 'USER', 1),
(213, 'Sommer', 'Simpson', 'ssimpson', '1234', 'ssimpson@gmail.com', 'ORGANIZER', 0),
(214, 'Daisy', 'Penn', 'dpenn', '1234', 'dpenn@gmail.com', 'USER', 1),
(215, 'Bruce', 'Parker', 'bparker', '1234', 'bparker@gmail.com', 'USER', 1);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`,`concert_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`concert_id`),
  ADD KEY `concert_fk` (`concert_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `concerts`
--
ALTER TABLE `concerts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `concert_fk` FOREIGN KEY (`concert_id`) REFERENCES `concerts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
