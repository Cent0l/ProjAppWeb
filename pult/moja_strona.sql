-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 15, 2025 at 03:27 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moja_strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`) VALUES
(1, 0, 'Kierownice'),
(2, 0, 'Komputery'),
(3, 0, 'Inne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `alias` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`, `alias`) VALUES
(1, 'Strona Główna', '<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"language\" content=\"pl\">\r\n    <meta name=\"author\" content=\"Mateusz Cętkowski\">\r\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\">\r\n    <title>Moje hobby to simracing</title>\r\n    <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\r\n    <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\r\n    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js\"></script>\r\n</head>\r\n<body>\r\n    <center>\r\n        <clock>\r\n            <div id=\"zegarek\"></div>\r\n            <div id=\"data\"></div>\r\n        </clock>\r\n    </center>\r\n\r\n    <div class=\"container\">\r\n        <h2>Wprowadzenie</h2>\r\n        <p><b>Strona</b> poświęcona simracingowi. <u>Prosty projekt</u> zapewnił nieprzespane noce.</p>\r\n\r\n        <h2>Obrazy w tabeli</h2>\r\n        <table>\r\n            <tr>\r\n                <td><img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/1_1.jpg\" alt=\"Obraz 1\"></td>\r\n                <td><img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/1_2.jpg\" alt=\"Obraz 2\"></td>\r\n                <td><img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/1_3.jpg\" alt=\"Obraz 3\"></td>\r\n                <td><img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/1_4.jpg\" alt=\"Obraz 4\"></td>\r\n            </tr>\r\n            <tr>\r\n                <td><img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/2_1.jpg\" alt=\"Obraz 5\"></td>\r\n                <td><img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/2_2.jpg\" alt=\"Obraz 6\"></td>\r\n                <td><img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/2_3.jpg\" alt=\"Obraz 7\"></td>\r\n                <td><img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/2_4.jpg\" alt=\"Obraz 8\"></td>\r\n            </tr>\r\n            <tr>\r\n                <td><img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/3_1.jpg\" alt=\"Obraz 9\"></td>\r\n                <td><img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/3_2.jpg\" alt=\"Obraz 10\"></td>\r\n                <td><img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/s.jpg\" alt=\"Obraz 11\"></td>\r\n                <td><img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/si.jpg\" alt=\"Obraz 12\"></td>\r\n            </tr>\r\n        </table>\r\n    </div>\r\n\r\n    <div>\r\n        <form method=\"POST\" name=\"background\" align=\"center\">\r\n            <input type=\"button\" value=\"żółty\" onclick=\"changeBackground(\'#FFF000\')\">\r\n            <input type=\"button\" value=\"czarny\" onclick=\"changeBackground(\'#000000\')\">\r\n            <input type=\"button\" value=\"biały\" onclick=\"changeBackground(\'#FFFFFF\')\">\r\n            <input type=\"button\" value=\"zielony\" onclick=\"changeBackground(\'#00FF00\')\">\r\n            <input type=\"button\" value=\"niebieski\" onclick=\"changeBackground(\'#0000FF\')\">\r\n            <input type=\"button\" value=\"pomarańczowy\" onclick=\"changeBackground(\'#FF8000\')\">\r\n            <input type=\"button\" value=\"szary\" onclick=\"changeBackground(\'#C0C0C0\')\">\r\n            <input type=\"button\" value=\"czerwony\" onclick=\"changeBackground(\'#FF0000\')\">\r\n            <input type=\"button\" value=\"default\" onclick=\"changeBackground(\'gray\')\">\r\n        </form>\r\n    </div>\r\n\r\n  \r\n\r\n</body>\r\n</html>\r\n', 1, 'home'),
(2, 'Gry', '<head>\n    <meta charset=\"UTF-8\">\n    <meta name=\"language\" content=\"pl\">\n    <meta name=\"author\" content=\"Mateusz Cętkowski\">\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\">\n    <title>Moje hobby to simracing</title>\n    <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\n    <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\n    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js\"></script>\n</head>\n<div class=\"content\">\n    <h2 class=\"section-title\">Simracing - Najlepsze gry wyścigowe</h2>\n    <p class=\"intro\">\n        Simracing to fascynująca forma rozrywki, która pozwala poczuć się jak zawodowy kierowca wyścigowy. Poniżej przedstawiamy trzy najpopularniejsze gry w tej kategorii:\n    </p>\n\n    <div class=\"container\">\n        <div class=\"game text-image\">\n            <img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/1_1.jpg\" alt=\"Assetto Corsa\" class=\"game-image\">\n            <h3 class=\"game-title\">Assetto Corsa</h3>\n            <p class=\"game-description\">\n                Assetto Corsa to kultowy symulator wyścigów, który oferuje niesamowity realizm zarówno pod względem fizyki pojazdów, jak i jakości wizualnej. Dzięki szerokim możliwościom modyfikacji, społeczność graczy stworzyła setki dodatkowych tras i pojazdów.\n            </p>\n        </div>\n\n        <div class=\"game text-image\">\n            <img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/2_1.jpg\" alt=\"iRacing\" class=\"game-image\">\n            <h3 class=\"game-title\">iRacing</h3>\n            <p class=\"game-description\">\n                iRacing to profesjonalny symulator, który koncentruje się na rywalizacji online. Gra posiada rozbudowany system lig i rankingów, co sprawia, że jest popularna wśród esportowców i entuzjastów motorsportu.\n            </p>\n        </div>\n\n        <div class=\"game text-image\">\n            <img src=\"https://raw.githubusercontent.com/Cent0l/ProjAppWeb/refs/heads/main/simracing/3_1.jpg\" alt=\"BeamNG.drive\" class=\"game-image\">\n            <h3 class=\"game-title\">BeamNG.drive</h3>\n            <p class=\"game-description\">\n                BeamNG.drive wyróżnia się zaawansowanym modelem fizyki i destrukcji pojazdów, pozwalając na realistyczne odwzorowanie kolizji i zachowania samochodów w różnych warunkach.\n            </p>\n        </div>\n    </div>\n\n    <p class=\"summary\">\n        Każda z tych gier oferuje unikalne doświadczenie, które przyciąga zarówno amatorów wyścigów, jak i profesjonalistów.\n    </p>\n</div>\n', 1, 'simracing-gry'),
(3, 'Koszta', '<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"language\" content=\"pl\">\r\n    <meta name=\"author\" content=\"Mateusz Cętkowski\">\r\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\">\r\n    <title>Moje hobby to simracing</title>\r\n    <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\r\n    <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\r\n    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js\"></script>\r\n</head>\r\n<div class=\"content\">\r\n        <h2 class=\"section-title\">Simracing - Koszty związane z pasją</h2>\r\n        <p class=\"intro\">\r\n            Simracing jest ekscytującym hobby, które może wymagać znacznych inwestycji w sprzęt. Poniżej znajdziesz przegląd podstawowych elementów oraz ich przybliżone koszty.\r\n        </p>\r\n\r\n        <div class=\"container\">\r\n            <div class=\"cost-item text-image\">\r\n                <h3 class=\"cost-title\">Komputer wysokiej klasy</h3>\r\n                <p class=\"cost-description\">\r\n                    W simracingu ważne jest posiadanie wydajnego komputera, który jest w stanie obsłużyć najnowsze gry wyścigowe w wysokiej rozdzielczości. Przykładowy koszt takiego komputera to około 5,000 - 8,000 zł.\r\n                </p>\r\n            </div>\r\n\r\n            <div class=\"cost-item text-image\">\r\n                <h3 class=\"cost-title\">Kierownice wyścigowe</h3>\r\n                <p class=\"cost-description\">\r\n                    Dobrej jakości kierownica z odpowiednim systemem Force Feedback zapewnia niezbędne wrażenia podczas wyścigów. Ceny zaczynają się od około 1,000 zł za podstawowe modele, do 5,000 zł i więcej za zaawansowane zestawy.\r\n                </p>\r\n            </div>\r\n\r\n            <div class=\"cost-item text-image\">\r\n                <h3 class=\"cost-title\">Fotel wyścigowy</h3>\r\n                <p class=\"cost-description\">\r\n                    Fotel wyścigowy, który oferuje ergonomiczną pozycję i może być integrowany z różnymi akcesoriami, kosztuje od 500 zł do 3,000 zł w zależności od funkcji i jakości wykonania.\r\n                </p>\r\n            </div>\r\n\r\n            <div class=\"cost-item text-image\">\r\n                <h3 class=\"cost-title\">VR (Virtual Reality)</h3>\r\n                <p class=\"cost-description\">\r\n                    Dla tych, którzy chcą zanurzyć się jeszcze głębiej w świat wyścigów, systemy VR są idealnym rozwiązaniem. Koszty zestawów VR do symulacji wyścigów zaczynają się od około 2,000 zł.\r\n                </p>\r\n            </div>\r\n        </div>\r\n\r\n        <p class=\"summary\">\r\n            Choć koszty związane z simracingiem mogą być wysokie, inwestycje te zwracają się poprzez niezrównane wrażenia i możliwość rywalizacji na najwyższym poziomie.\r\n        </p>\r\n    </div>', 1, 'simracing-koszty'),
(4, 'Skrypty', '<!DOCTYPE html>\r\n<html lang=\"pl\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"language\" content=\"pl\">\r\n    <meta name=\"author\" content=\"Mateusz Cętkowski\">\r\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\">\r\n    <title>Test Skryptów</title>\r\n    <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\r\n    <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\r\n    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js\"></script>\r\n</head>\r\n<body onload=\"startclock()\">\r\n    \r\n    <h1>Ta strona służy do testowania skryptów</h1>\r\n\r\n    <br><br><br>\r\n    <div>\r\n        <form method=\"POST\" name=\"background\">\r\n            <input type=\"button\" value=\"żółty\" onclick=\"changeBackground(\'#FFF000\')\">\r\n            <input type=\"button\" value=\"czarny\" onclick=\"changeBackground(\'#000000\')\">\r\n            <input type=\"button\" value=\"biały\" onclick=\"changeBackground(\'#FFFFFF\')\">\r\n            <input type=\"button\" value=\"zielony\" onclick=\"changeBackground(\'#00FF00\')\">\r\n            <input type=\"button\" value=\"niebieski\" onclick=\"changeBackground(\'#0000FF\')\">\r\n            <input type=\"button\" value=\"pomarańczowy\" onclick=\"changeBackground(\'#FF8000\')\">\r\n            <input type=\"button\" value=\"szary\" onclick=\"changeBackground(\'#C0C0C0\')\">\r\n            <input type=\"button\" value=\"czerwony\" onclick=\"changeBackground(\'#FF0000\')\">\r\n        </form>\r\n    </div>\r\n\r\n    <br><br>\r\n    <div>\r\n        <div id=\"zegarek\"></div>\r\n        <div id=\"data\"></div>\r\n    </div>\r\n\r\n    <br><br>\r\n    <div id=\"animacjaTestowa1\" class=\"test-block\">\r\n        <button id=\"btn1\">Kliknij</button>\r\n    </div>\r\n    <script>\r\n        $(\"#btn1\").on(\"click\", function() {\r\n            $(\"#animacjaTestowa1\").animate({\r\n                width: \"500px\",\r\n                fontSize: \"3em\",\r\n                borderWidth: \"10px\"\r\n            }, 800);\r\n        });\r\n    </script>\r\n\r\n    <br><br>\r\n    <div id=\"animacjaTestowa2\" class=\"test-block\">\r\n        <button id=\"btn2\">Najedź kursorem</button>\r\n    </div>\r\n    <script>\r\n        $(\"#btn2\").on({\r\n            \"mouseover\": function() {\r\n                $(\"#animacjaTestowa2\").animate({ width: 300 }, 800);\r\n            },\r\n            \"mouseout\": function() {\r\n                $(\"#animacjaTestowa2\").animate({ width: 200 }, 800);\r\n            }\r\n        });\r\n    </script>\r\n\r\n    <br><br>\r\n    <div id=\"animacjaTestowa3\" class=\"test-block\">\r\n        <button id=\"btn3\">Kliknij</button>\r\n    </div>\r\n    <script>\r\n        $(\"#btn3\").on(\"click\", function() {\r\n            if (!$(\"#animacjaTestowa3\").is(\":animated\")) {\r\n                $(\"#animacjaTestowa3\").animate({\r\n                    width: \"+=50\",\r\n                    height: \"+=10\",\r\n                    opacity: \"+=0.1\"\r\n                }, 3000);\r\n            }\r\n        });\r\n    </script>\r\n\r\n</body>\r\n</html>\r\n', 1, NULL),
(5, 'Filmy', '<!DOCTYPE html>\r\n<html lang=\"pl\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"language\" content=\"pl\">\r\n    <meta name=\"author\" content=\"Mateusz Cętkowski\">\r\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\">\r\n    <title>Moje hobby to simracing</title>\r\n    <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\r\n    <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\r\n    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js\"></script>\r\n</head>\r\n<body>\r\n\r\n    <main class=\"content\">\r\n        <h2>Odtwarzacze Wideo</h2>\r\n        <p>Poniżej znajdują się trzy filmy wideo związane z tematem simracingu:</p>\r\n        <div class=\"video-container\">\r\n            <!-- Odtwarzacz 1 -->\r\n            <iframe src=\"https://www.youtube.com/embed/iOpHDP0xXzA\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n            \r\n            <!-- Odtwarzacz 2 -->\r\n            <iframe src=\"https://www.youtube.com/embed/nYeM4J7N_mo\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n            \r\n            <!-- Odtwarzacz 3 -->\r\n            <iframe src=\"https://www.youtube.com/embed/lK8NmbqutR0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n        </div>\r\n    </main>\r\n</body>\r\n</html>\r\n', 1, NULL),
(6, 'Sklep', '<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"language\" content=\"pl\">\r\n    <meta name=\"author\" content=\"Mateusz Cętkowski\">\r\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\">\r\n    <title>Moje hobby to simracing</title>\r\n    <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\r\n    <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\r\n    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js\"></script>\r\n</head>\r\n\r\n', 1, 'sklep');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expires_at` date DEFAULT NULL,
  `net_price` decimal(10,2) DEFAULT NULL,
  `vat_rate` decimal(5,2) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `availability_status` tinyint(4) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_size` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `created_at`, `updated_at`, `expires_at`, `net_price`, `vat_rate`, `stock_quantity`, `availability_status`, `category_id`, `product_size`, `image_url`) VALUES
(1, 'Logitech G29', 'Profesjonalna kierownica do symulatorów wyścigowych.', '2025-01-11 21:05:46', '2025-01-11 21:16:24', '2025-12-31', 1200.00, 23.00, 15, 1, 1, 'Standard', 'https://resource.logitech.com/content/dam/gaming/en/products/drivingforce/g920-gallery-1-2.png'),
(2, 'Thrustmaster T300RS', 'Kierownica o wysokim stopniu realizmu.', '2025-01-11 21:05:46', '2025-01-11 21:16:55', '2025-12-31', 1800.00, 23.00, 10, 1, 1, 'Standard', 'https://image.ceneostatic.pl/data/products/50673525/i-thrustmaster-t300-rs-gt-4160681.jpg'),
(3, 'Alienware Aurora', 'Wysokiej klasy komputer stacjonarny dla graczy.', '2025-01-11 21:05:46', '2025-01-11 21:17:22', '2025-12-31', 8000.00, 23.00, 5, 1, 2, 'Standard', 'https://dell24.pl/photos/604f44aa2b8c24.60512972.jpeg'),
(4, 'Dell XPS 15', 'Wydajny laptop do gier i pracy.', '2025-01-11 21:05:46', '2025-01-11 21:17:46', '2025-12-31', 6500.00, 23.00, 8, 1, 2, '15 cali', 'https://dell24.pl/photos/6278cdc0611d9.jpg'),
(5, 'Samsung Odyssey G7', 'Monitor gamingowy z zakrzywionym ekranem.', '2025-01-11 21:05:46', '2025-01-11 21:18:23', '2025-12-31', 2200.00, 23.00, 20, 1, 3, '32 cali', 'https://images.samsung.com/is/image/samsung/p6pim/in/ls28bg700ewxxl/gallery/in-odyssey-g7-g70b-ls28bg700ewxxl-534804809?$684_547_PNG$'),
(6, 'Oculus Rift S', 'Gogle VR do wirtualnej rzeczywistości.', '2025-01-11 21:05:46', '2025-01-11 21:19:01', '2025-12-31', 1500.00, 23.00, 25, 1, 3, 'VR', 'https://f00.osfr.pl/foto/8/28635196897/ef6f9592b6a23b92275af06eb664a165/archival-garett-rift-touch-vr-motion-controller,28635196897_5.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
