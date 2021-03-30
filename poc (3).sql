-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2021 at 05:56 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poc`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_component`
--

CREATE TABLE `mst_component` (
  `id` int(11) NOT NULL,
  `component` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mst_financial_year`
--

CREATE TABLE `mst_financial_year` (
  `id` int(11) NOT NULL,
  `start_year` varchar(55) NOT NULL,
  `end_year` varchar(55) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mst_items`
--

CREATE TABLE `mst_items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mst_rate_type`
--

CREATE TABLE `mst_rate_type` (
  `id` int(11) NOT NULL,
  `rate_type` varchar(155) NOT NULL,
  `rate` int(11) NOT NULL,
  `premium_rate` int(11) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mst_role`
--

CREATE TABLE `mst_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mst_role_mapping`
--

CREATE TABLE `mst_role_mapping` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mst_scheme`
--

CREATE TABLE `mst_scheme` (
  `id` int(11) NOT NULL,
  `scheme` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_in` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mst_ulb`
--

CREATE TABLE `mst_ulb` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mst_ward`
--

CREATE TABLE `mst_ward` (
  `id` int(11) NOT NULL,
  `ward_number` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trans_budget`
--

CREATE TABLE `trans_budget` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `scheme_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `financial_year_id` int(11) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `uploaded_file` varchar(400) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trans_budget_proposal`
--

CREATE TABLE `trans_budget_proposal` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `budget_id` int(11) NOT NULL,
  `ulb_id` int(11) NOT NULL,
  `amount_demanded` decimal(18,2) NOT NULL,
  `allocation_type` varchar(100) NOT NULL,
  `status` enum('1','2','3','4') NOT NULL,
  `approved_by` int(11) NOT NULL,
  `uploaded_file` varchar(400) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trans_wms`
--

CREATE TABLE `trans_wms` (
  `id` int(11) NOT NULL,
  `work_code_number` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ulb_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `scheme_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `financial_year_id` int(11) NOT NULL,
  `work_name` varchar(255) NOT NULL,
  `work_type` varchar(255) NOT NULL,
  `work_sub_type` varchar(255) NOT NULL,
  `work_scope` varchar(255) NOT NULL,
  `announcement_type` varchar(255) NOT NULL,
  `announcement_no` varchar(255) NOT NULL,
  `announcement_date` datetime NOT NULL,
  `site_plan_file` varchar(255) NOT NULL,
  `cross_section_file` varchar(255) NOT NULL,
  `l_section_file` varchar(255) NOT NULL,
  `google_map_file` varchar(255) NOT NULL,
  `city_map_file` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `is_revised` enum('Y','N') NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trans_wms_approval_level`
--

CREATE TABLE `trans_wms_approval_level` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `wms_id` int(11) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trans_wms_work_items`
--

CREATE TABLE `trans_wms_work_items` (
  `id` int(11) NOT NULL,
  `wms_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `number1` decimal(18,2) DEFAULT NULL,
  `number2` decimal(18,2) DEFAULT NULL,
  `number3` decimal(18,2) DEFAULT NULL,
  `length` decimal(18,2) NOT NULL,
  `breadth` decimal(18,2) NOT NULL,
  `height` decimal(18,2) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate_type_id` int(11) NOT NULL,
  `total_rate` decimal(18,2) NOT NULL,
  `total_amount` decimal(18,2) NOT NULL,
  `status` enum('1','2','3','4') NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_component`
--
ALTER TABLE `mst_component`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_financial_year`
--
ALTER TABLE `mst_financial_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_items`
--
ALTER TABLE `mst_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_rate_type`
--
ALTER TABLE `mst_rate_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_role`
--
ALTER TABLE `mst_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_role_mapping`
--
ALTER TABLE `mst_role_mapping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `mst_scheme`
--
ALTER TABLE `mst_scheme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_ulb`
--
ALTER TABLE `mst_ulb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_ward`
--
ALTER TABLE `mst_ward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_budget`
--
ALTER TABLE `trans_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_budget_proposal`
--
ALTER TABLE `trans_budget_proposal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_id` (`budget_id`);

--
-- Indexes for table `trans_wms`
--
ALTER TABLE `trans_wms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_wms_ibfk_1` (`ulb_id`),
  ADD KEY `scheme_id` (`scheme_id`),
  ADD KEY `component_id` (`component_id`),
  ADD KEY `financial_year_id` (`financial_year_id`),
  ADD KEY `ward_id` (`ward_id`);

--
-- Indexes for table `trans_wms_approval_level`
--
ALTER TABLE `trans_wms_approval_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `tbl_wms_approval_level_ibfk_2` (`wms_id`);

--
-- Indexes for table `trans_wms_work_items`
--
ALTER TABLE `trans_wms_work_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wms_id` (`wms_id`),
  ADD KEY `rate_type_id` (`rate_type_id`),
  ADD KEY `item_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_component`
--
ALTER TABLE `mst_component`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_financial_year`
--
ALTER TABLE `mst_financial_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_items`
--
ALTER TABLE `mst_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_rate_type`
--
ALTER TABLE `mst_rate_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_role`
--
ALTER TABLE `mst_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_role_mapping`
--
ALTER TABLE `mst_role_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_scheme`
--
ALTER TABLE `mst_scheme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_ulb`
--
ALTER TABLE `mst_ulb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_ward`
--
ALTER TABLE `mst_ward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans_budget`
--
ALTER TABLE `trans_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans_budget_proposal`
--
ALTER TABLE `trans_budget_proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans_wms`
--
ALTER TABLE `trans_wms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans_wms_approval_level`
--
ALTER TABLE `trans_wms_approval_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans_wms_work_items`
--
ALTER TABLE `trans_wms_work_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mst_role_mapping`
--
ALTER TABLE `mst_role_mapping`
  ADD CONSTRAINT `mst_role_mapping_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `mst_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trans_budget_proposal`
--
ALTER TABLE `trans_budget_proposal`
  ADD CONSTRAINT `trans_budget_proposal_ibfk_1` FOREIGN KEY (`budget_id`) REFERENCES `trans_budget` (`id`);

--
-- Constraints for table `trans_wms`
--
ALTER TABLE `trans_wms`
  ADD CONSTRAINT `trans_wms_ibfk_1` FOREIGN KEY (`ulb_id`) REFERENCES `mst_ulb` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_wms_ibfk_2` FOREIGN KEY (`scheme_id`) REFERENCES `mst_scheme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_wms_ibfk_3` FOREIGN KEY (`component_id`) REFERENCES `mst_component` (`id`),
  ADD CONSTRAINT `trans_wms_ibfk_4` FOREIGN KEY (`financial_year_id`) REFERENCES `mst_financial_year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_wms_ibfk_5` FOREIGN KEY (`ward_id`) REFERENCES `mst_ward` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trans_wms_approval_level`
--
ALTER TABLE `trans_wms_approval_level`
  ADD CONSTRAINT `trans_wms_approval_level_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `mst_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_wms_approval_level_ibfk_2` FOREIGN KEY (`wms_id`) REFERENCES `trans_wms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trans_wms_work_items`
--
ALTER TABLE `trans_wms_work_items`
  ADD CONSTRAINT `trans_wms_work_items_ibfk_1` FOREIGN KEY (`wms_id`) REFERENCES `trans_wms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_wms_work_items_ibfk_2` FOREIGN KEY (`rate_type_id`) REFERENCES `mst_rate_type` (`id`),
  ADD CONSTRAINT `trans_wms_work_items_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `mst_items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
