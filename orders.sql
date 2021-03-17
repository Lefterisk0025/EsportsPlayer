-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 31 Δεκ 2019 στις 14:07:08
-- Έκδοση διακομιστή: 10.4.10-MariaDB
-- Έκδοση PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `orders`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `registers`
--

CREATE TABLE `registers` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(30) NOT NULL,
  `payment method` varchar(10) NOT NULL,
  `orderDetails` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `registers`
--

INSERT INTO `registers` (`username`, `password`, `fullname`, `email`, `birthday`, `address`, `payment method`, `orderDetails`, `comments`) VALUES
('lefterisk', 'Lefterisk', 'ELEFTHERIOS KONTOURIS', 'something@exapmle.com', '2001-01-25', 'SOMEWHERE INGREECE 25', 'Visa', 'White Shirt 1: 2 White Shirt 2: 1 Fnatic Jacket: 3 Mouse - Rekkles Edition: 1 Mousepad - Rekkles Edition: 2 Elo Boost: 3 Total Price: 475', 'No comments. Peace!'),
('kostas', 'hytrferd', 'KOSTAS KAPOIOS', 'random@example.com', '1997-07-07', 'SOMEWHERE BEAUTIFUL 55', 'Paypal', 'White Shirt 1: 2 White Shirt 2: 1 Fnatic Jacket: 3 Mouse - Rekkles Edition: 1 Mousepad - Rekkles Edition: 2 Elo Boost: 3 Total Price: 475', 'Packed in gold box'),
('dhmhtris', 'zxcvbgfds', 'DIMITRIS KAPOIOSODEUYTEROS', 'someone@example.com', '1995-02-05', 'SOMEWHERE INGREECE 87', 'Viva walle', 'White Shirt 1: 3    Mousepad - Rekkles Edition: 2  Total Price: 110', '10000000 comments');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
