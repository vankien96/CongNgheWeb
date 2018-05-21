-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 21, 2018 lúc 06:25 AM
-- Phiên bản máy phục vụ: 10.1.26-MariaDB
-- Phiên bản PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `congngheweb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `billing_details`
--

CREATE TABLE `billing_details` (
  `billing_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `billing_details`
--

INSERT INTO `billing_details` (`billing_id`, `member_id`, `address`, `city`, `phone`) VALUES
(2, 12, 'Tôn đức thắng', 'Đà Nẵng', '0121356986');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_details`
--

CREATE TABLE `cart_details` (
  `cart_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` float NOT NULL,
  `flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_details`
--

INSERT INTO `cart_details` (`cart_id`, `member_id`, `food_id`, `quantity`, `total`, `flag`) VALUES
(1, 3, 15, 1, 350000, 1),
(2, 3, 13, 1, 300000, 1),
(3, 3, 1, 1, 150000, 1),
(15, 12, 1, 1, 150000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(8, 'Khai Vị'),
(9, 'Món Chay'),
(10, 'Món Khô'),
(11, 'Món Chính');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `currencies`
--

CREATE TABLE `currencies` (
  `currency_id` int(11) NOT NULL,
  `currency_symbol` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `currencies`
--

INSERT INTO `currencies` (`currency_id`, `currency_symbol`, `flag`) VALUES
(1, 'VNĐ', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `food_details`
--

CREATE TABLE `food_details` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `food_description` text COLLATE utf8_unicode_ci NOT NULL,
  `food_price` float NOT NULL,
  `food_photo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `food_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `food_details`
--

INSERT INTO `food_details` (`food_id`, `food_name`, `food_description`, `food_price`, `food_photo`, `food_category`) VALUES
(1, 'Bánh Huế thập cẩm', 'Vì bánh bèo được đổ theo kiểu khác, cũng kiểu Huế nhưng dày hơn, có xoáy nhẹ và đặc biệt dùng tôm tươi giã nhuyễn', 150000, 'banhhue.jpg', 8),
(2, 'Bánh Nam Bộ thập cẩm', 'Gồm bánh it tran, bánh bột lọc và bánh đúc nước cốt dừa mặn', 150000, 'nam-bo-640x480.jpg', 8),
(3, 'Chả giò chuối hải sản', 'Set 5 cuốn sốt mayonaise bên trong và chấm tí sốt pha tương ớt bên ngoài', 125000, 'cha-gio-chuoi-640x480.jpg', 8),
(4, 'Chả giò tôm cua', 'Set 10 cuốn chả giò ăn kèm dưa leo và tương ớt', 120000, 'cha-gio-tom-cua-684x480.jpg', 8),
(5, 'Cà ri chay', 'Cà ri chay, kèo kẹo, sốt hơi sệt nhẹ nhờ chất bột tứa ra từ khoai laing& khoai môn thêm cà tím, ba rô, nấm rơm, tàu hủ ki, thế thôi mà thành món ngon tuyệt, chấm tí muối ớt thì hóa ra nồng nàn sự đời, chẳng nhớ là đang ăn chay nữa (vì Gánh tin có nhiều người giống Gánh, ăn cà ri gà cũng chỉ ăn tuyền nước với rau củ, mê đắm nhất là khoai lang thôi, chẳng thiết đến gà, thì đây, cà ri chay nhà Gánh đây, chấm bánh mì cũng ngon mà ăn kèm bún& giá, húng lủi càng ngon)', 230000, 'ca-ri-chay.jpg', 9),
(6, 'Kiểm chay', 'Chỉ nấu vào các này rằm', 150000, 'kiem-chay.jpg', 9),
(7, 'Lẩu chay', '1 lẩu lớn 4-5 người dùng', 250000, 'lau-nam-chay.jpg', 9),
(8, 'Mắm ruốc chay', 'Khách ghé Nàng Gánh lâu lâu hay ăn chay, đôi khi chỉ là mẻ rau luộc lên, khách đòi làm chút nước tương mằn mặn kiểu nước tương kho để khách chấm rau, thế là đủ', 95000, 'mam-ruoc-chay.jpg', 9),
(9, 'Bún đậu mắm tôm', 'Phần lớn cho 4 người dùng', 220000, 'bun-dau-mam-tom.jpg', 11),
(10, 'Cá bông mú hấp sen và nấm', 'Công phu nhất nằm ở giai đoạn làm nước sốt: nước dùng từ thịt heo, hầm chung ngò rí& hành lá còn nguyên rễ, thêm chút hành tây, hầm lửa riu riu đến khi nước thiệt thơm lừng, sau đó cho dầu hào, nước tương, gia vị vào vừa ăn, tùy theo người nấu mà canh lửa, canh độ sệt và mức thanh tao cho nước sốt.', 980000, 'bong-mu-640x480.jpg', 11),
(11, 'Cá tai tượng chiên xù', 'Cá tai tượng sống làm sạch, bỏ mang ruột, ngâm trong nước muối khoảng 15 phút cho cá bớt nhớt, để ráo nước và chiên vàng đều (chảo nhiều dầu để cá mau chín) và xù đẹp\r\nMón này cuốn ăn kèm với rau sống, bánh ráng và bún. Chấm với mắm nêm.', 380000, 'Caataituong.png', 11),
(12, 'Cánh gà ngào nước mắm', 'Cánh gà ta, chặt miếng vừa ăn, ướp gia vị cho thấm& chiên giòn thật giòn với dầu sôi, vớt ra, để ráo, dùng giấy thấm dầu thấm thiệt kỹ rồi ngào với nước mắm pha chút tiêu đường…', 320000, 'CanhGangao.png', 11),
(13, 'Bún bò xào Nam Bộ', 'Bún bò khô thơm ngon đặc biệt của vùng sông nước Nam Bộ', 300000, 'bun-thit-nuong-cha-gio-nem-lui-280x180.jpg', 10),
(14, 'Bún thịt nướng chả giò', 'Nem truyền thống kết hợp với một chút đặc biệt của nhà hàng sẽ đem đến một khẩu vị tuyệt vời', 250000, 'bun-thit-nuong-cha-gio-nem-lui-280x180.jpg', 10),
(15, 'Cơm chiên cá mặn gà xé', 'Đầy đủ dưỡng chất, âm dương hội tụ', 350000, 'com-chien-ca-man-280x180.jpg', 10),
(16, 'Cơm chiên Dương Châu', 'Dương Châu tàu khựa', 250000, 'com-chien-duong-chau-280x180.jpg', 10),
(17, 'Chè khúc bạch thập cẩm', 'Giải nhiệt cơ thể một cách nhanh chóng đông thời đây cũng là món ăn bổ dưỡng', 35000, 'khuc-bach-tc.jpg', 8),
(18, 'Hạt điều ngào mạch nha', 'Hạt điều bùi kết hợp vị ngọt mát của mạch nha sẽ là món ngon sau bữa ăn chính', 200000, 'hat-dieu-ngao-mach-nha-nuoc-mam.jpg', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `question_id` int(5) NOT NULL,
  `answer` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`member_id`, `firstname`, `lastname`, `email`, `password`, `question_id`, `answer`) VALUES
(3, 'Trần Đức', 'Long', 'longmup@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 'bfdb6633ad86a2ba23e1a2b436a844b1'),
(4, 'Trương Văn', 'Kiên', 'vankien@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 2, 'bfdb6633ad86a2ba23e1a2b436a844b1'),
(12, 'Lưu Ngọc', 'Lan', 'lan@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 2, 'bda9643ac6601722a28f238714274da4');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message_from` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `message_date` date NOT NULL,
  `message_time` time NOT NULL,
  `message_subject` text COLLATE utf8_unicode_ci NOT NULL,
  `message_text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`message_id`, `message_from`, `message_date`, `message_time`, `message_subject`, `message_text`) VALUES
(1, 'administrator', '2018-05-10', '20:07:57', 'Xin chào thành viên mới', 'Xin chào quý khách đã đên với hệ thống website của nhà hàng Food Plaza. Chúc quý khách có những bữa ăn ngon miệng!');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_details`
--

CREATE TABLE `orders_details` (
  `order_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `billing_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `delivery_date` date NOT NULL,
  `StaffID` int(11) NOT NULL,
  `flag` int(1) NOT NULL,
  `time_stamp` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders_details`
--

INSERT INTO `orders_details` (`order_id`, `member_id`, `billing_id`, `cart_id`, `delivery_date`, `StaffID`, `flag`, `time_stamp`) VALUES
(1, 3, 1, 1, '2016-05-10', 1, 1, '21:01:01'),
(2, 3, 1, 2, '2016-05-10', 1, 1, '21:01:16'),
(3, 3, 1, 3, '2016-05-10', 0, 0, '21:17:04'),
(4, 12, 2, 0, '2018-05-21', 0, 0, '05:51:01'),
(5, 12, 2, 0, '2018-05-21', 0, 0, '05:51:05'),
(6, 12, 2, 0, '2018-05-21', 0, 0, '10:53:49'),
(7, 12, 2, 0, '2018-05-21', 0, 0, '10:53:56'),
(11, 12, 2, 12, '2018-05-21', 0, 0, '10:57:10'),
(12, 12, 2, 11, '2018-05-21', 0, 0, '11:08:04'),
(13, 12, 2, 11, '2018-05-21', 0, 0, '11:08:51'),
(14, 12, 2, 11, '2018-05-21', 0, 0, '11:17:51'),
(15, 12, 2, 15, '2018-05-21', 0, 0, '11:23:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `partyhalls`
--

CREATE TABLE `partyhalls` (
  `partyhall_id` int(11) NOT NULL,
  `partyhall_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `partyhalls`
--

INSERT INTO `partyhalls` (`partyhall_id`, `partyhall_name`) VALUES
(1, 'Hội trường A'),
(2, 'Hội trường B'),
(3, 'Hội trường C'),
(4, 'Hội trường D'),
(5, 'Hội trường E'),
(6, 'Hội trường F'),
(7, 'Hội trường G'),
(8, 'Hội trường H'),
(9, 'Hội trường I');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `polls_details`
--

CREATE TABLE `polls_details` (
  `poll_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `rate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `polls_details`
--

INSERT INTO `polls_details` (`poll_id`, `member_id`, `food_id`, `rate_id`) VALUES
(7, 12, 17, 2),
(8, 12, 16, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question_text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `questions`
--

INSERT INTO `questions` (`question_id`, `question_text`) VALUES
(1, 'Ngày sinh âm lịch của bạn là gi?'),
(2, 'Màu sắc bạn yêu thích là gì?'),
(3, 'Bạn thích con vật nào?'),
(4, 'Bạn học lại mấy môn trong thời sinh viên?');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

CREATE TABLE `ratings` (
  `rate_id` int(11) NOT NULL,
  `rate_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ratings`
--

INSERT INTO `ratings` (`rate_id`, `rate_name`) VALUES
(2, 'Rất ngon'),
(3, 'Ngon'),
(4, 'Bình thường'),
(5, 'Tệ'),
(6, 'Quá tệ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reservations_details`
--

CREATE TABLE `reservations_details` (
  `ReservationID` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `partyhall_id` int(11) NOT NULL,
  `Reserve_Date` date NOT NULL,
  `Reserve_Time` time NOT NULL,
  `StaffID` int(11) NOT NULL,
  `flag` int(1) NOT NULL,
  `table_flag` int(1) NOT NULL,
  `partyhall_flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reservations_details`
--

INSERT INTO `reservations_details` (`ReservationID`, `member_id`, `table_id`, `partyhall_id`, `Reserve_Date`, `Reserve_Time`, `StaffID`, `flag`, `table_flag`, `partyhall_flag`) VALUES
(2, 3, 0, 2, '2016-05-25', '20:01:00', 2, 1, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `specials`
--

CREATE TABLE `specials` (
  `special_id` int(11) NOT NULL,
  `special_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `special_description` text COLLATE utf8_unicode_ci NOT NULL,
  `special_price` float NOT NULL,
  `special_start_date` date NOT NULL,
  `special_end_date` date NOT NULL,
  `special_photo` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `specials`
--

INSERT INTO `specials` (`special_id`, `special_name`, `special_description`, `special_price`, `special_start_date`, `special_end_date`, `special_photo`) VALUES
(1, 'Chè khúc bạch thập cẩm', 'Giải nhiệt cơ thể một cách nhanh chóng đông thời đây cũng là món ăn bổ dưỡng', 35000, '2016-05-10', '2016-05-31', 'khuc-bach-tc.jpg'),
(2, 'Hạt điều ngào mạch nha', 'Hạt điều bùi kết hợp vị ngọt mát của mạch nha sẽ là món ngon sau bữa ăn chính', 200000, '2016-05-20', '2016-05-30', 'hat-dieu-ngao-mach-nha-nuoc-mam.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `firstname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Street_Address` text COLLATE utf8_unicode_ci NOT NULL,
  `Mobile_Tel` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `staff`
--

INSERT INTO `staff` (`StaffID`, `firstname`, `lastname`, `Street_Address`, `Mobile_Tel`) VALUES
(1, 'Đoàn', 'Dự', 'Võ Đang', '123458785'),
(2, 'Chu Bá', 'Thông', 'Hoa Sơn', '454697466');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tables`
--

CREATE TABLE `tables` (
  `table_id` int(11) NOT NULL,
  `table_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tables`
--

INSERT INTO `tables` (`table_id`, `table_name`) VALUES
(1, 'Bàn số 1'),
(2, 'Bàn số 2'),
(3, 'Bàn số 3'),
(4, 'Bàn số 4'),
(5, 'Bàn số 5'),
(6, 'Bàn số 6'),
(7, 'Bàn số 7'),
(8, 'Bàn số 8'),
(9, 'Bàn số 9'),
(10, 'Bàn số 10'),
(11, 'Bàn số 11'),
(12, 'Bàn số 12'),
(13, 'Bàn số 13'),
(14, 'Bàn số 14'),
(15, 'Bàn số 15'),
(16, 'Bàn số 16'),
(17, 'Bàn số 17'),
(18, 'Bàn số 18'),
(19, 'Bàn số 19'),
(20, 'Bàn số 20'),
(21, 'Bàn số 21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `billing_details`
--
ALTER TABLE `billing_details`
  ADD PRIMARY KEY (`billing_id`);

--
-- Chỉ mục cho bảng `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`cart_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`currency_id`);

--
-- Chỉ mục cho bảng `food_details`
--
ALTER TABLE `food_details`
  ADD PRIMARY KEY (`food_id`);

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Chỉ mục cho bảng `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `partyhalls`
--
ALTER TABLE `partyhalls`
  ADD PRIMARY KEY (`partyhall_id`);

--
-- Chỉ mục cho bảng `polls_details`
--
ALTER TABLE `polls_details`
  ADD PRIMARY KEY (`poll_id`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rate_id`);

--
-- Chỉ mục cho bảng `reservations_details`
--
ALTER TABLE `reservations_details`
  ADD PRIMARY KEY (`ReservationID`);

--
-- Chỉ mục cho bảng `specials`
--
ALTER TABLE `specials`
  ADD PRIMARY KEY (`special_id`);

--
-- Chỉ mục cho bảng `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Chỉ mục cho bảng `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `billing_details`
--
ALTER TABLE `billing_details`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `currencies`
--
ALTER TABLE `currencies`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `food_details`
--
ALTER TABLE `food_details`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `partyhalls`
--
ALTER TABLE `partyhalls`
  MODIFY `partyhall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `polls_details`
--
ALTER TABLE `polls_details`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `reservations_details`
--
ALTER TABLE `reservations_details`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `specials`
--
ALTER TABLE `specials`
  MODIFY `special_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
