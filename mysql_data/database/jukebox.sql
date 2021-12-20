SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `jukebox` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `jukebox`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `keyrock_id` varchar(120) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `email` varchar(130) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `keyrock_id`, `confirmed`, `email`) VALUES
(2, 'admin', 1, 'dpetrou@isc.tuc.gr'),
(3, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', 1, 'yvasileiou@test.com'),
(4, 'b5f07c98-e681-46bd-ba00-da5bc9af6c63', 1, 'tpapadopoulos@test.com'),
(5, 'c13b5926-635c-4378-8365-8853ac7a79e2', 1, 'hsmith@test.com'),
(6, '53c2dde8-36af-4df2-be39-1f961de28dad', 0, 'jkearns@test.com'),
(7, 'b03dbc8d-1be7-441c-9bbe-f4d3e66012fd', 1, 'esaunders@test.com'),
(8, '78760423-2569-4c62-bc0a-ca76e39cdf4b', 0, 'pmcdonald@test.com'),
(9, 'b7720165-fdac-4294-939d-98fc0eb9955a', 1, 'dpenn@test.com'),
(10, '109d97f8-e3f9-4a43-bfc9-d5a1bc5579eb', 0, 'jsimpson@test.com'),
(12, '1c762085-be51-4d13-9ea9-881c20d1890e', 1, 'lanthony@test.com');


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE DATABASE IF NOT EXISTS `idm` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `idm`;

CREATE TABLE `authzforce` (
  `az_domain` varchar(255) NOT NULL,
  `policy` char(36) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `auth_token` (
  `access_token` varchar(255) NOT NULL,
  `expires` datetime DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `pep_proxy_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `auth_token` (`access_token`, `expires`, `valid`, `user_id`, `pep_proxy_id`) VALUES
('00af4ace-b74f-4f68-94c2-d8767044e84e', '2021-12-18 01:03:15', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('01fb2315-9a2d-4453-896d-dfb55b3fd4d0', '2021-12-15 22:01:44', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('02da254b-2913-4365-a596-3fd6078d0c6f', '2021-12-07 12:38:00', 1, 'admin', NULL),
('046a7ca6-62b7-46f8-90fe-f3301759b2dc', '2021-12-06 23:55:59', 1, 'admin', NULL),
('04b81627-8be2-4658-9338-86b2ce3e911b', '2021-12-07 13:14:57', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('05d954bf-28a5-421b-99e9-80c1252cecb5', '2021-12-18 23:51:00', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('05f61441-4609-4030-9c7a-bec26c73cebf', '2021-12-19 21:46:18', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('06688995-b728-4afe-80a3-d04722128251', '2021-12-06 22:48:25', 1, 'admin', NULL),
('076be22a-6e74-45be-8a02-31f62826f8e4', '2021-12-07 16:13:50', 1, 'admin', NULL),
('07b1f72b-24de-48a5-bdc6-067f6df6f803', '2021-12-06 22:43:28', 1, 'admin', NULL),
('0836d710-ade7-4240-b9a7-ceffe4e4f894', '2021-12-19 21:45:08', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('08862305-e7cd-4eea-a815-7597c010400c', '2021-12-17 03:45:14', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('08880d11-cf25-403a-a003-3b7a055d70ef', '2021-12-18 01:19:35', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('08d3a945-ea3d-43b5-8644-191317fb4561', '2021-12-18 20:57:33', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('08db3965-25e9-4c59-b3f5-edd6bacade66', '2021-12-07 16:34:59', 1, 'admin', NULL),
('093002ed-a524-434b-883a-7e867e1b051b', '2021-12-06 22:43:30', 1, 'admin', NULL),
('096ff8ca-80d7-43c1-825f-ebd0ffa3d02a', '2021-12-15 21:48:23', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('098d5508-7d10-45c0-83f1-f106009232f4', '2021-12-07 16:08:33', 1, 'admin', NULL),
('0a8cbcad-7b00-4e94-a9ee-3339204d1ba3', '2021-12-17 04:06:56', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('0ab505e3-6f3c-45ad-b169-4e006b4b5d9a', '2021-12-15 22:13:51', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('0bd1499e-b848-4311-abd4-f57397fb388e', '2021-12-20 00:26:41', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('0cf86d40-7106-4012-a94e-51071ea61647', '2021-12-06 22:43:31', 1, 'admin', NULL),
('0d0f0524-9147-4bf6-8f61-13515593f6b7', '2021-12-18 01:27:50', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('0d757475-e72e-4fc9-b267-f789ec286da1', '2021-12-06 22:13:23', 1, 'admin', NULL),
('0ecdc53f-9c6e-41cd-a3d9-1e50a98cbc82', '2021-12-06 22:14:29', 1, 'admin', NULL),
('104b5a24-c577-43bb-9211-5b0eaf269a4b', '2021-12-18 22:42:22', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('12c7c396-be06-4231-abbf-88b3158f3d9e', '2021-12-18 01:24:22', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('12e657b9-0302-4f2a-8e91-c9e2e970f7aa', '2021-12-19 01:40:44', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('13673313-3778-42e6-971a-7870ae31e76f', '2021-12-07 16:13:25', 1, 'admin', NULL),
('13e2e8e5-e0c9-41c6-8ae9-340c4b368615', '2021-12-07 13:19:14', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('149ede30-5085-4c2b-99aa-dcf5ca6a65a1', '2021-12-18 23:31:26', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('16e9a2ff-fb63-4696-8b1b-388e74280d05', '2021-12-14 03:50:34', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('17997ddc-f749-497c-84a6-b02497c8e064', '2021-12-07 12:36:53', 1, 'admin', NULL),
('19d24a49-cbee-4efe-b071-d7644b2f90dd', '2021-12-06 22:45:13', 1, 'admin', NULL),
('1abd7716-a267-4d12-978d-5b5da57e2da8', '2021-12-07 19:57:57', 1, 'admin', NULL),
('1b19ed8a-9cd5-488a-89e9-4869faab080d', '2021-12-10 16:44:32', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('1d906061-e55b-49cb-a766-5e344af9f955', '2021-12-17 03:54:12', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('21f18801-0edc-4aea-bde2-bbd198769542', '2021-12-06 22:48:25', 1, 'admin', NULL),
('22bbf62d-8f1a-443e-9237-2bffd2798adf', '2021-12-14 00:13:45', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('22d42a1d-d987-4cb8-adc8-d9bc6121201d', '2021-12-06 22:41:16', 1, 'admin', NULL),
('24043048-1d81-4042-96bc-0f742d0b8ac6', '2021-12-20 03:30:23', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('24ce274e-ed64-4969-9db6-9ddc1880b3a5', '2021-12-07 18:42:57', 1, 'admin', NULL),
('24d3aad0-62f6-4c80-8efd-e61f4c7c0554', '2021-12-07 16:44:31', 1, 'b5f07c98-e681-46bd-ba00-da5bc9af6c63', NULL),
('259cbd92-ca87-49e3-9a67-e19656492427', '2021-12-07 12:43:55', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('265b7c74-e0f1-4472-b959-1c24af79f22b', '2021-12-06 23:46:04', 1, 'admin', NULL),
('28be06e2-38ba-4c91-b72c-ff71d8444f34', '2021-12-18 14:57:59', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('29493205-de98-490b-ac70-dd1087111351', '2021-12-20 03:30:23', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('2a74df83-ec9c-43bc-9b9f-1e0151ae9ddb', '2021-12-07 13:14:49', 1, 'admin', NULL),
('2ac5854c-ff8a-4e6b-ab59-a6679bb5d5ef', '2021-12-07 16:15:00', 1, 'admin', NULL),
('2b131462-6ea3-405a-813c-a1b2647f1e51', '2021-12-19 01:47:46', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('2bb39819-03c6-491e-96f9-bf880c6947d4', '2021-12-07 11:52:17', 1, 'admin', NULL),
('2bdbc741-a22f-4cf5-9bb9-abd4e9aaaaeb', '2021-12-20 00:17:46', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('2d5abd3b-ca9a-4496-bb79-1f09cfcfdf62', '2021-12-06 22:48:25', 1, 'admin', NULL),
('2dce5871-eca1-41e1-9170-0cb87a1800e6', '2021-12-07 12:46:32', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('300359a0-b845-40b5-838e-6607291301e0', '2021-12-20 03:20:54', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('30812d0a-500e-431f-8ea2-8fae2d04b669', '2021-12-06 22:43:31', 1, 'admin', NULL),
('312ce42b-417d-41f7-97e3-9f58501c2dfb', '2021-12-18 01:26:46', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('31593c67-58e6-48e5-adab-4a503ee5489b', '2021-12-18 23:52:20', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('32461c7a-27d2-4d2c-b1d4-155ef17b6175', '2021-12-18 23:53:05', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('325b57bb-fd6e-4ba3-bcfe-f5abd48c9513', '2021-12-20 03:30:21', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('337fc54c-9f3d-49b2-b135-57ed2b76ddd7', '2021-12-17 01:22:57', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('3388370d-bdab-4286-aa28-5f1aeea35cf1', '2021-12-07 12:44:51', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('34118bbd-9f0b-4f75-8ce7-33a708baff71', '2021-12-07 15:57:38', 1, 'admin', NULL),
('341a2eaf-72c7-4e54-b858-9a10e1381988', '2021-12-16 22:17:46', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('34bb159b-1f4c-478b-9f64-ed5bbcd27875', '2021-12-17 22:29:05', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('34d6c459-6145-4f7d-b08f-04d08961f448', '2021-12-18 23:31:33', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('367bea0e-2e5e-4cbe-97ba-1cddb25835b9', '2021-12-15 17:25:50', 1, 'admin', NULL),
('375fcb23-8285-4f3a-87e9-0a55a4a0b58f', '2021-12-06 22:47:49', 1, 'admin', NULL),
('396b1105-65f0-4a13-aa25-3e708dbbe889', '2021-12-07 12:52:52', 1, 'admin', NULL),
('39935c2e-446e-4b34-8cf3-9a9299f845a1', '2021-12-07 13:19:57', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('3a54c8db-1174-4c6d-965a-cd06730342d5', '2021-12-07 12:56:11', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('3b8e2fac-9fc1-4900-a84b-1df71b296954', '2021-12-06 22:43:32', 1, 'admin', NULL),
('3c9c88d3-2a57-4af9-ba19-1803b4157783', '2021-12-17 23:37:45', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('3df6fc49-531f-4e33-b214-b7a32bfc4944', '2021-12-06 23:57:48', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('3fa916f1-c8fb-4062-be73-ba8e612192de', '2021-12-07 16:35:19', 1, 'admin', NULL),
('40271bd1-6d65-493c-a4ea-e61dbdc06632', '2021-12-07 16:12:44', 1, 'admin', NULL),
('4072e64b-791e-4aa0-a258-ea952ee54c96', '2021-12-06 22:43:32', 1, 'admin', NULL),
('42513043-af31-4ac0-bcc5-dd828daad19b', '2021-12-06 23:56:27', 1, 'admin', NULL),
('45c106a9-4932-4bca-9a28-8f0d13f019a5', '2021-12-07 12:38:39', 1, 'admin', NULL),
('461e2132-e41b-4f06-85dd-ba470ae291ab', '2021-12-06 23:53:28', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('4878630c-382d-4d84-b188-5357492b224a', '2021-12-07 12:45:34', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('48f652f7-4293-4e2f-a29e-30af5c8a44da', '2021-12-06 22:43:30', 1, 'admin', NULL),
('491c59cb-5c0c-49ec-be03-6938cd4c38b2', '2021-12-19 21:01:02', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('4962a241-44e9-4b85-8872-863933d419b2', '2021-12-06 22:14:56', 1, 'admin', NULL),
('4967aac1-53a3-43f1-a915-5f3cf335f601', '2021-12-07 12:38:52', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('49722938-c592-4600-9807-44a5d9bc4dd6', '2021-12-06 22:48:22', 1, 'admin', NULL),
('49b50a01-d2a1-4817-836e-1ecedf58b6f8', '2021-12-07 12:37:13', 1, 'admin', NULL),
('49c3b0ef-2d67-4cf6-a3df-264e4cb98738', '2021-12-07 15:53:09', 1, 'admin', NULL),
('4a65a84f-a2da-47c3-9d70-a1156f756de4', '2021-12-07 12:38:09', 1, 'admin', NULL),
('4b40259c-663a-4f25-b46e-cdac3f851113', '2021-12-15 18:10:52', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('4ba64f23-ec61-4a00-98f3-a372644df46e', '2021-12-06 22:40:24', 1, 'admin', NULL),
('4bfc0803-7d88-4b4d-b2e5-dd70a460d0b7', '2021-12-07 00:23:51', 1, 'admin', NULL),
('4da37691-f39f-4ac2-addd-be7ed8ab2bdc', '2021-12-09 13:25:46', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('4dfb818a-1366-45b0-9c3b-ced3614eba80', '2021-12-18 23:51:37', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('4f38229d-22da-49fb-8360-2e02dde572a6', '2021-12-16 20:55:26', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('50597ed4-fcf4-4585-b0fa-87e8a173cdb0', '2021-12-07 00:26:54', 1, 'admin', NULL),
('5186ea93-abd3-4252-8258-872b622552d5', '2021-12-06 23:53:18', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('51a53259-0b29-48f2-ba78-c68f498f96a8', '2021-12-17 17:43:26', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('53cf417d-aaab-417a-837f-e3a3a804490e', '2021-12-06 23:56:21', 1, 'admin', NULL),
('54397512-37ee-46ce-ad6b-05eaa6785daf', '2021-12-06 22:43:29', 1, 'admin', NULL),
('562400ee-cbea-4495-9f7f-05538ed2149b', '2021-12-14 01:11:40', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('5818f93a-cd2e-4819-a8d7-a88928485bb9', '2021-12-07 16:39:30', 1, 'admin', NULL),
('581ded6a-6f41-4e00-8ab7-752132eb5809', '2021-12-17 03:50:34', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('58e7729e-64e6-426e-8b90-32d6b05d8510', '2021-12-06 22:43:29', 1, 'admin', NULL),
('592727b1-708b-474e-854b-52173782ed50', '2021-12-18 23:49:44', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('59f97111-0f16-479c-b230-f9bccb8214ca', '2021-12-07 12:46:40', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('5a38b23b-0a22-4867-888f-b652d6e5c57f', '2021-12-17 17:56:36', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('5b0d4ca7-227e-4269-a4d1-abad65c85cd6', '2021-12-19 20:18:14', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('5bf0603d-26a7-47fb-96fb-1ff5dbb21e97', '2021-12-18 23:53:24', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('5c325c1c-fa20-440e-9b65-dfad77caac7f', '2021-12-07 12:36:44', 1, 'admin', NULL),
('5c615307-f543-4111-bd54-84abcdb11afa', '2021-12-15 17:26:14', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('5dd2bdf8-5074-487e-ba07-8b6f91d99ee7', '2021-12-20 03:20:51', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('5f077505-2296-4c14-b0f6-63a27cf94797', '2021-12-10 16:44:57', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('5f2c005e-bf63-492c-bcbd-a2ce48973b35', '2021-12-06 22:47:46', 1, 'admin', NULL),
('5fcf84a4-f674-49a8-bdad-d8c2a5aed72b', '2021-12-06 22:48:24', 1, 'admin', NULL),
('6015168c-37d3-4c9a-90e7-901230ac5212', '2021-12-17 03:55:56', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('6082ab22-67e8-4bf2-b04d-f4d223b99da3', '2021-12-06 22:14:54', 1, 'admin', NULL),
('60b35351-8d68-4b02-9271-62a64cbe5393', '2021-12-06 23:44:52', 1, 'admin', NULL),
('60e98995-ff1e-4e91-adef-4e7d2302afc8', '2021-12-06 22:14:55', 1, 'admin', NULL),
('6581708f-4622-4f54-8a93-10f2d6f5e791', '2021-12-18 01:29:15', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('65c13fb3-96ed-4547-8f4e-c87804c908a5', '2021-12-15 21:51:42', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('65cc1471-9dca-42dd-850c-e1d35e81f923', '2021-12-20 03:20:54', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('687b4ed8-c274-42be-8b7d-6697ec28dc36', '2021-12-16 20:55:05', 1, 'admin', NULL),
('68a8f6d9-2b3c-4570-81df-6c9300fbe162', '2021-12-18 01:44:36', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('6def5073-5304-42cd-b95b-640028350b12', '2021-12-20 03:20:51', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('6e918eb5-5bbd-4fef-9d3d-1f4bb0ffc6cf', '2021-12-06 22:14:30', 1, 'admin', NULL),
('70a4905c-e9ed-44c9-95be-330f88717f08', '2021-12-06 22:43:31', 1, 'admin', NULL),
('70eab0c1-1b45-46b5-9101-73f1e81087d8', '2021-12-06 23:56:25', 1, 'admin', NULL),
('72bfffc4-e5e2-4ecd-bd1d-589224efd8ad', '2021-12-15 22:13:16', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('72fc945c-e8f8-4714-81d6-5339a47275a4', '2021-12-20 03:30:22', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('74658814-79a1-4e83-abd8-ee0533634cee', '2021-12-07 00:18:19', 1, 'admin', NULL),
('74a04070-cfd3-4133-ab44-35f4b877533d', '2021-12-07 12:57:25', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('759c095a-8c35-4c4e-b916-d9a21a3ed7d4', '2021-12-07 13:18:17', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('76121448-1253-41b7-9b9c-46f802b8a392', '2021-12-13 23:11:29', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('76ad37a3-fbbb-4fe6-8157-981fbd8c2eb3', '2021-12-18 00:21:59', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('77b2532b-1e4b-48ae-8bcc-557347afc1db', '2021-12-07 12:30:04', 1, 'admin', NULL),
('791fa136-b5d5-41ce-a4a9-6e795718b2ff', '2021-12-07 16:38:40', 1, 'admin', NULL),
('795b476d-a40e-4beb-af70-1f6a7d3abbde', '2021-12-07 15:58:38', 1, 'admin', NULL),
('7a5f61e4-1d2d-40c4-aaf0-19242ff2f1b2', '2021-12-14 00:33:07', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('7a66a15f-498c-418b-9339-9d1967ddbf2f', '2021-12-07 16:16:41', 1, 'admin', NULL),
('7a9db718-0358-46e5-ba38-24ebcdd0c083', '2021-12-14 02:11:31', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('7bb4eed7-38e2-49cc-9b08-71e4d57b355b', '2021-12-15 21:51:54', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('7c8d2a1a-e13a-4af6-adc2-feb46eb8e3ff', '2021-12-20 00:13:31', 1, 'admin', NULL),
('7dc6faf2-0b79-43d7-b14d-1d2186c75cca', '2021-12-07 12:53:43', 1, 'admin', NULL),
('7f681cea-45a4-4fc1-8959-dd06f337c74f', '2021-12-07 19:51:34', 1, 'admin', NULL),
('80523da6-6997-4ff1-88f5-9d2f8513d0ce', '2021-12-07 16:13:48', 1, 'admin', NULL),
('816c744c-92fe-4efd-a470-1bd16dfce5a8', '2021-12-07 12:38:54', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('8551017f-eaab-4021-8104-7b52a2c8ea88', '2021-12-07 11:57:56', 1, 'admin', NULL),
('879e1df4-710f-4e0e-93af-598411a2c484', '2021-12-15 21:59:48', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('88140f07-ec57-4003-9532-fcd3b7d9aa24', '2021-12-07 19:39:26', 1, 'admin', NULL),
('895d9cde-8111-4868-8a1d-1e26e0606aa8', '2021-12-17 03:53:05', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('8969b186-6d50-4c5b-8d65-d2516be86e29', '2021-12-20 02:00:33', 1, 'admin', NULL),
('8a2ecbee-d568-4526-921f-e3a171a4dab0', '2021-12-10 16:43:36', 1, 'admin', NULL),
('8a52a240-5bff-4495-bf8b-085ac5fbc59c', '2021-12-07 16:10:51', 1, 'admin', NULL),
('8ac895be-7e1c-4159-b600-17c8a6c26e1a', '2021-12-07 11:52:39', 1, 'admin', NULL),
('8ae6ff7e-1900-453a-82a6-76b6cad7a424', '2021-12-15 17:40:59', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('8bdf9edd-5f6f-45a8-a170-7661dc525eb5', '2021-12-07 13:19:36', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('8c6ced67-e501-4a6d-8d92-62e2d0ed036a', '2021-12-06 22:43:29', 1, 'admin', NULL),
('8df343d9-65d3-4230-bd4e-963aa49be1e0', '2021-12-07 12:45:48', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('8f43fd1a-0a2f-4863-9c3e-a6a8b791fca7', '2021-12-18 23:52:27', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('9022b4a4-95f8-4cf8-8560-b5676a008967', '2021-12-06 22:43:29', 1, 'admin', NULL),
('90436544-1aff-475b-9959-fb02634aa123', '2021-12-07 16:11:04', 1, 'admin', NULL),
('91840ea6-4563-4a23-b447-1aaf343cc991', '2021-12-13 23:11:46', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('94d36a13-01d6-4c64-b54d-5bb2c1b5de6a', '2021-12-06 22:43:30', 1, 'admin', NULL),
('94de43e2-959d-401a-bf09-c8ef3b060be7', '2021-12-07 00:21:49', 1, 'admin', NULL),
('954522ae-65e0-4e58-be0f-1d4b2e5bcd0d', '2021-12-19 20:38:26', 1, 'admin', NULL),
('95649291-8569-4d3d-823f-2ab65d2899d6', '2021-12-07 12:54:01', 1, 'admin', NULL),
('95ef313b-6e73-4100-b4b3-0885b688a0c8', '2021-12-20 03:30:23', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('966d9ff5-945c-4492-b206-63e80f67d12c', '2021-12-17 02:14:15', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('99ca24e6-20e4-4fd7-a649-2111485bac97', '2021-12-20 00:17:58', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('9a7adbf1-5562-4869-8337-29cfb53e97a0', '2021-12-06 22:43:06', 1, 'admin', NULL),
('9a7b6b4e-b463-46fb-aa67-88b95cf07d85', '2021-12-06 22:43:30', 1, 'admin', NULL),
('9abaaf11-cb4f-43de-80f3-4c69c998a202', '2021-12-06 23:45:04', 1, 'admin', NULL),
('9b0115a8-4907-42c5-980e-ac62da82107a', '2021-12-07 11:53:01', 1, 'admin', NULL),
('9da03df9-3092-489d-9593-d695d75324a2', '2021-12-17 17:55:15', 1, 'c13b5926-635c-4378-8365-8853ac7a79e2', NULL),
('9e3277e0-c6de-491d-84c5-3c7e67c3e569', '2021-12-19 21:01:03', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('9ed8bd11-6c14-4292-9630-ba82f91c9d69', '2021-12-07 15:16:28', 1, 'admin', NULL),
('9f86d426-596f-451d-b509-21dcd3ae0948', '2021-12-15 22:31:37', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('a1695410-af7d-4043-a118-643dab81ec95', '2021-12-20 02:27:32', 1, 'admin', NULL),
('a22ccb67-b601-40a9-a7e7-30adcf6ef615', '2021-12-06 22:43:32', 1, 'admin', NULL),
('a2656b67-703b-4be9-aab0-25eaa901ad11', '2021-12-06 22:48:26', 1, 'admin', NULL),
('a311873d-532d-4aac-88de-fff0124bcff1', '2021-12-20 03:30:21', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('a3eaa51c-dc4b-4451-aa0b-dfc012f7101e', '2021-12-09 13:24:54', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('a4454c24-c436-4198-b160-d93ed1e015a5', '2021-12-06 22:48:25', 1, 'admin', NULL),
('a4a0c70a-7cd2-4d1a-816b-35669ffba848', '2021-12-06 22:48:24', 1, 'admin', NULL),
('a598a843-c3b7-42b9-81d8-080c06e68687', '2021-12-18 01:52:42', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('a66984ac-a043-403a-8a6a-2f832bc69511', '2021-12-18 15:27:56', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('a671c6e4-1e72-49fb-ae2f-423a0477b855', '2021-12-07 16:15:19', 1, 'admin', NULL),
('a68a65e9-e0f2-4f47-9c7d-c925bc4bfc0d', '2021-12-18 21:26:50', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('a863fa8c-74ce-43ef-8033-f7748826ecbc', '2021-12-18 15:15:46', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('a9171b3f-bef1-44d4-932e-e0efd93fe7d5', '2021-12-06 22:48:25', 1, 'admin', NULL),
('aa457e14-f580-478d-a228-fa17c4f4b041', '2021-12-14 02:05:35', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('aaef16ff-b346-4030-9c69-8f80067aed10', '2021-12-06 22:43:29', 1, 'admin', NULL),
('ad5471d6-2aab-4378-a90b-bb176038b442', '2021-12-15 18:17:44', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('ae01fb82-7a5f-4848-9006-12b26fea9486', '2021-12-19 21:43:01', 1, 'admin', NULL),
('b041304d-39db-408e-ace9-fbf5bde8b15b', '2021-12-14 03:33:07', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('b072b56d-5e42-4333-b3bc-6de41ab2b069', '2021-12-06 22:48:26', 1, 'admin', NULL),
('b07d0dd8-d729-467d-b546-8591e3d4a471', '2021-12-06 22:41:18', 1, 'admin', NULL),
('b170226d-684f-447e-94a5-a45707727c3d', '2021-12-06 22:40:28', 1, 'admin', NULL),
('b1cda61c-e9a9-4f8f-9a5d-f56f8e1d46b8', '2021-12-06 22:48:26', 1, 'admin', NULL),
('b2d7e8de-0728-464a-ad55-4dfd263462c5', '2021-12-20 00:26:43', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('b2fc666b-e6d1-47a6-9505-2a35ceb624f7', '2021-12-09 13:22:03', 1, 'admin', NULL),
('b45bb917-e8f3-409d-975e-e3f634c3d101', '2021-12-07 16:11:42', 1, 'admin', NULL),
('b497f88e-d343-4a4b-8db7-5e8332fae5a3', '2021-12-06 23:55:04', 1, 'admin', NULL),
('b49cf0bb-dd5f-4ed3-9ec7-cf9e0fe38c55', '2021-12-06 22:14:55', 1, 'admin', NULL),
('b4e8e1d3-ff49-4824-b925-414d04b9eab1', '2021-12-07 12:49:53', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('b510d7b1-8032-4439-b447-1b4c42a697cc', '2021-12-06 22:43:28', 1, 'admin', NULL),
('b5db596c-e82f-4da2-a033-322a7e0c1258', '2021-12-14 03:15:51', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('b77ce01f-9cf0-4dc5-bd1e-76b993726568', '2021-12-07 15:57:50', 1, 'admin', NULL),
('b79bb669-f0b8-4f94-a505-9abed51be47b', '2021-12-07 19:53:58', 1, 'admin', NULL),
('b8023ca1-0cb7-4886-bc83-4b468a6d01dd', '2021-12-19 20:18:14', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('b8c3380b-d4f3-422a-ae6d-c989308d876e', '2021-12-07 16:08:52', 1, 'admin', NULL),
('ba22b972-a62f-4245-bba8-a72a8c5d0927', '2021-12-18 01:44:01', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('ba2932e3-c15c-4f62-948c-4ff63a4b4363', '2021-12-06 22:42:49', 1, 'admin', NULL),
('bac3455e-a923-4f8c-b433-b0c58e6d46fc', '2021-12-16 22:33:09', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('bb34770a-07c1-49f5-b3c5-dbbfdd695f11', '2021-12-20 02:27:40', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('bb85f9a0-10e3-4c89-b069-529439f4fa6a', '2021-12-07 12:45:36', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('bc2de473-e5ab-4c6e-8683-0e6a62ad2b9b', '2021-12-20 00:13:40', 1, 'admin', NULL),
('bc4958a8-17cc-466f-bf8e-90380fca3dcb', '2021-12-07 16:14:24', 1, 'admin', NULL),
('bcdf2292-4ea3-42ba-9ade-340e20c257ff', '2021-12-17 23:20:45', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('bd770d7c-8b9c-4384-bdb5-13de1b25394b', '2021-12-07 19:54:10', 1, 'admin', NULL),
('bd95f9d6-53cc-4475-b9bd-164a1ff5abb2', '2021-12-17 22:02:32', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('be0b4c75-6b79-4d91-b730-9fcf775c31ea', '2021-12-06 23:53:29', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('bedd744e-4fdd-4939-a2eb-02a3df899287', '2021-12-18 20:33:48', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('bef9f779-b801-4b6d-84ca-afed383adcf2', '2021-12-06 23:45:44', 1, 'admin', NULL),
('bf4f4779-881e-4ca0-acdd-ead5f47d9a1a', '2021-12-17 22:27:16', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('bfcee7d6-9aef-4208-b642-2b22ff6a128f', '2021-12-06 22:14:28', 1, 'admin', NULL),
('c2c307cd-28fb-4217-9197-9032d7ad837e', '2021-12-18 01:03:21', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('c54d7497-9bf5-4127-8c75-1829be0e6b10', '2021-12-07 15:58:53', 1, 'admin', NULL),
('c9f4614e-cbb3-4c60-9323-adc95a049fb1', '2021-12-06 23:56:29', 1, 'admin', NULL),
('ca17c660-c52e-457c-af0e-b2fae48cacbe', '2021-12-14 03:43:30', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('ca3ae81f-b5a3-4f89-9896-4eb4c7e5765e', '2021-12-20 03:20:54', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('ca47570e-f31c-4621-a99c-c71f6ac75832', '2021-12-18 22:40:30', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('cae39b73-f0f3-421d-8079-d605be44e1c8', '2021-12-07 16:18:31', 1, 'admin', NULL),
('cda45569-b1e4-4c86-b121-41f71a27570d', '2021-12-07 19:02:28', 1, 'admin', NULL),
('cdba901a-4d3f-429f-9afc-af8a38298332', '2021-12-07 12:38:25', 1, 'admin', NULL),
('ce8cab02-af69-4ca9-919b-8cf914d11f78', '2021-12-17 23:46:32', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('d0bcc3d8-5bda-4a32-9ef6-9a83e710c925', '2021-12-07 14:54:20', 1, 'admin', NULL),
('d138dcd8-e94a-4aa6-9fde-6cfa406b1015', '2021-12-20 01:58:04', 1, 'admin', NULL),
('d14dc40e-105b-483b-9b82-8a8c18397e3e', '2021-12-07 16:32:17', 1, 'b5f07c98-e681-46bd-ba00-da5bc9af6c63', NULL),
('d1babb65-b72f-4d2e-8d40-c33a6e63be67', '2021-12-07 19:37:06', 1, 'admin', NULL),
('d213b142-f6dc-4077-b548-d97b1facb6a4', '2021-12-17 17:51:05', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('d46e8bad-343e-464f-b8bc-2eb6a1d42930', '2021-12-06 23:57:51', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('d74f763f-e267-4220-948b-b41c463fbc68', '2021-12-20 00:26:43', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('d75c6c9c-a28b-4e04-96b1-32650951d5de', '2021-12-06 22:48:25', 1, 'admin', NULL),
('d7ce7b64-6a92-41f9-8186-3e633d4eaa6c', '2021-12-07 16:17:52', 1, 'admin', NULL),
('d8c9251a-8085-4e56-b7c7-f2eca3903f9a', '2021-12-06 23:53:30', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('d8d3afab-0a0d-47be-a929-95c719dd483c', '2021-12-13 23:01:36', 1, 'admin', NULL),
('d911efaf-2dd8-4e5a-a34f-5ab685270e49', '2021-12-07 16:38:23', 1, 'admin', NULL),
('d9612b26-14eb-4e2f-b03b-5a2aa2bcd170', '2021-12-17 01:19:18', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('da569aad-a575-4a56-a09f-3e07b73a85cc', '2021-12-06 22:43:29', 1, 'admin', NULL),
('dd84d299-1bfc-48fd-a7df-db8368a4df85', '2021-12-16 22:12:19', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('e1339a1d-6ab3-47c7-ad56-4d89dfef7f74', '2021-12-19 03:06:34', 1, 'admin', NULL),
('e301055b-f9cf-4ef6-a0ac-402c6f6fa682', '2021-12-06 22:43:27', 1, 'admin', NULL),
('e4c3fb13-96ba-4780-87f2-6ab9f25ce426', '2021-12-18 15:18:27', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('e7633953-6784-4a3c-b2b6-5b4ceb5e2d29', '2021-12-07 15:03:31', 1, 'admin', NULL),
('e79f78e0-e0c5-45ad-b85c-5f53347a855f', '2021-12-17 22:52:43', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('e84065fe-644b-42b6-b736-da47c26ef316', '2021-12-07 16:20:21', 1, 'b5f07c98-e681-46bd-ba00-da5bc9af6c63', NULL),
('eadcb94c-c553-48d3-9f88-dca39b5e5f10', '2021-12-18 01:56:10', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('eb255031-d2e3-415c-845a-287fd2135e09', '2021-12-06 23:53:30', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('eb64afd9-020d-4707-ae61-d99c251475dd', '2021-12-07 16:11:46', 1, 'admin', NULL),
('ecabbaaa-4cdf-4e94-95a7-289317fb01b0', '2021-12-18 23:52:55', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('ecd00040-df58-47c9-bc9f-dca8dd0c5e59', '2021-12-20 03:20:54', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('ed070519-a770-4a43-ab11-ec84c04a8931', '2021-12-06 22:48:24', 1, 'admin', NULL),
('ed9cc88e-4bbe-4f3e-9052-715c989c1e28', '2021-12-06 22:43:30', 1, 'admin', NULL),
('ee089524-9304-4105-b3b0-558e7dd9e4ef', '2021-12-07 16:42:27', 1, 'admin', NULL),
('ef305869-e7c9-4ad5-83ea-411a80942652', '2021-12-07 16:20:03', 1, 'b5f07c98-e681-46bd-ba00-da5bc9af6c63', NULL),
('f011f859-5500-42ef-ad51-2d7327ab84e3', '2021-12-07 19:51:50', 1, 'admin', NULL),
('f068197f-5331-441f-97eb-11231a26f7fa', '2021-12-19 20:18:13', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('f0f3be9e-4246-4728-b555-0df2c0404ebf', '2021-12-07 12:44:20', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('f0fd3714-29a9-4574-8fdb-62ad97970e09', '2021-12-19 21:01:04', 1, NULL, 'pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e'),
('f1650c08-b7da-4adb-ae83-5271407bfe2d', '2021-12-18 23:30:55', 1, '1c762085-be51-4d13-9ea9-881c20d1890e', NULL),
('f1db7240-c5c8-40e3-9588-cce521082bfd', '2021-12-20 01:59:04', 1, 'admin', NULL),
('f1dd35c1-c66a-4f65-9fb8-844fa1b95f21', '2021-12-07 16:11:59', 1, 'admin', NULL),
('f307e212-8642-4739-8172-d68f56830d00', '2021-12-07 16:15:07', 1, 'admin', NULL),
('f31da0d3-f662-43e6-a299-779d10f0f9ee', '2021-12-07 12:58:46', 1, 'admin', NULL),
('f3caae8e-f2a0-4e2a-807e-b8969a996705', '2021-12-07 16:09:31', 1, 'admin', NULL),
('f48078e1-0b26-4fcb-a729-cb91ca501593', '2021-12-07 11:23:58', 1, 'admin', NULL),
('f52070c0-d313-4699-a800-45065376a19f', '2021-12-06 22:43:28', 1, 'admin', NULL),
('f5436342-70f3-4783-b507-fb0d1287d790', '2021-12-17 03:32:24', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('f666c22f-c483-4588-b100-5246bd581fef', '2021-12-07 16:12:35', 1, 'admin', NULL),
('f6809c1b-ffba-4838-b96b-dd357eaa31af', '2021-12-07 16:12:23', 1, 'admin', NULL),
('f74a9fc4-4a02-4341-8ef2-b9b8a496031d', '2021-12-06 22:43:28', 1, 'admin', NULL),
('f785489b-64df-4a83-9752-9ad8d6b31fb9', '2021-12-06 22:43:28', 1, 'admin', NULL),
('f857800c-a43d-4f7c-b314-39d84c98b53d', '2021-12-17 02:18:09', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('f91e3e27-5799-4b7d-8b7c-dade5c5e63d6', '2021-12-06 22:48:24', 1, 'admin', NULL),
('fb1b5639-0408-441c-8dba-c394a929617c', '2021-12-07 16:39:15', 1, 'admin', NULL),
('fcac7323-d986-45a2-9fe1-d8a9e631c815', '2021-12-15 17:26:35', 1, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL),
('fd40e8a4-2f86-4a25-b508-7c49a8b1e59c', '2021-12-07 16:36:05', 1, 'admin', NULL),
('ffb9607f-80a5-4197-a6c5-d8d8da5e23b0', '2021-12-07 12:30:24', 1, 'admin', NULL);

CREATE TABLE `delegation_evidence` (
  `policy_issuer` varchar(255) NOT NULL,
  `access_subject` varchar(255) NOT NULL,
  `policy` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `eidas_credentials` (
  `id` varchar(36) NOT NULL,
  `support_contact_person_name` varchar(255) DEFAULT NULL,
  `support_contact_person_surname` varchar(255) DEFAULT NULL,
  `support_contact_person_email` varchar(255) DEFAULT NULL,
  `support_contact_person_telephone_number` varchar(255) DEFAULT NULL,
  `support_contact_person_company` varchar(255) DEFAULT NULL,
  `technical_contact_person_name` varchar(255) DEFAULT NULL,
  `technical_contact_person_surname` varchar(255) DEFAULT NULL,
  `technical_contact_person_email` varchar(255) DEFAULT NULL,
  `technical_contact_person_telephone_number` varchar(255) DEFAULT NULL,
  `technical_contact_person_company` varchar(255) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `organization_url` varchar(255) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `organization_nif` varchar(255) DEFAULT NULL,
  `sp_type` varchar(255) DEFAULT 'private',
  `attributes_list` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iot` (
  `id` varchar(255) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `oauth_access_token` (
  `access_token` text NOT NULL,
  `expires` datetime DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  `extra` json DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `iot_id` varchar(255) DEFAULT NULL,
  `authorization_code` varchar(255) DEFAULT NULL,
  `hash` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `oauth_access_token` (`access_token`, `expires`, `scope`, `refresh_token`, `valid`, `extra`, `oauth_client_id`, `user_id`, `iot_id`, `authorization_code`, `hash`) VALUES
('57573dbe42c96a84efa53b688d5ee56d7d99692e', '2021-12-20 01:58:04', 'bearer', 'e58b00840b49513990dff69619c855caa2a98ddd', 1, NULL, '803f4f84-c658-4c56-88bd-cebedf07eb24', 'admin', NULL, NULL, '2d0701f956f2e4ee1e2825de16af000a425d9cc52c6dc322a181cd12b54d999a'),
('6e71743fc2b2edeb035713e54d9bde7a14c42c09', '2021-12-20 00:17:46', 'bearer', 'b1c17df6ee574b8a8d3b46ea6a491264cfafeed7', 1, NULL, '803f4f84-c658-4c56-88bd-cebedf07eb24', '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL, NULL, '31418626b0c527b142bbd95d44097f047b9642b9a307d0d79eb140072beabc86'),
('db29b75a57819f5df4362102873cb9115b3c4e6b', '2021-12-20 02:00:33', 'bearer', 'a6775e3f96f0f7d3c2e231f88500b1d11fb2e467', 1, NULL, '803f4f84-c658-4c56-88bd-cebedf07eb24', 'admin', NULL, NULL, '379f9515b373e0489a0d6262b609e5414a6229b49a3d43a8f94d253c80b4e7d1'),
('470c22372c968739c158b6df8a1227c40b2e8cd5', '2021-12-19 21:45:08', 'bearer', '8897880c9f3a8b20044614fe9a2c85b52ec342c6', 1, NULL, '803f4f84-c658-4c56-88bd-cebedf07eb24', '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL, NULL, '590889694cfbb91c55b691facf2ff6885fe02b68e9a4f4e4e2fdf2b5161d24d1'),
('e464712b59e2fefed344ef5bdf558f35e9333120', '2021-12-20 02:27:40', 'bearer', 'c881ac906ea55b7ab0c3b34416380cbe475d106c', 1, NULL, '803f4f84-c658-4c56-88bd-cebedf07eb24', '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL, NULL, '65a0d4241009a6703e279e520a1c12e710481e2d89bfc55b6c31f7bc0ff032e3'),
('0cabe008c8811e2e97ca6f207d45d3039e68d21c', '2021-12-20 00:13:40', 'bearer', 'ccb417dd4cc9b07795df930ea25e9d241dbebe2f', 1, NULL, '803f4f84-c658-4c56-88bd-cebedf07eb24', 'admin', NULL, NULL, '6ba95cc87b0f616e5b11a20a2d06745097679e09c1a8a9ecce97d8b42ec0ec38'),
('9dd497d6042f09ea6dc679c01644be7ba6c8906a', '2021-12-19 21:43:01', 'bearer', '143e841329b9aac2e67e6e7621cb4da7390a903b', 1, NULL, '803f4f84-c658-4c56-88bd-cebedf07eb24', 'admin', NULL, NULL, '9b0fa20bc1701ff2798397e0bcc062ffad03a934cf77ee44f9ae3927c3eff4a6'),
('021771e681260361874067fd00b822b3269cb0b4', '2021-12-19 21:46:19', 'bearer', '790751328d817a16e3da4ab46d81e76d9993d86a', 1, NULL, '803f4f84-c658-4c56-88bd-cebedf07eb24', '1c762085-be51-4d13-9ea9-881c20d1890e', NULL, NULL, 'd2fe77c4b3bd9eae7d2fb4a9fa76fe56624fc6938ad9d680bd67c3cbcf0a285a'),
('65e91a7993ab0654bb7fa0188e9fc3b1ac5ada07', '2021-12-20 02:27:33', 'bearer', '5fa0d66e7011f873d7b37257ee0b01dc7a8c7d57', 1, NULL, '803f4f84-c658-4c56-88bd-cebedf07eb24', 'admin', NULL, NULL, 'd8b9145b5d7221e5960f370782dd5666272b6aae72f2b5f21fe41d624378964c'),
('90e25378d0419f17cb26fe3acb7ff0ebd7c63a9b', '2021-12-20 01:59:04', 'bearer', '2a0047943d8251191e9138de890259375707b035', 1, NULL, '803f4f84-c658-4c56-88bd-cebedf07eb24', 'admin', NULL, NULL, 'f7460be8752e1ab1b6a48a5e390e55c6ca4d11f59d6e1fa214d4331fd1b3caee'),
('3f2006fb9304b4da87a23d0851aef30df6b29f31', '2021-12-20 00:17:58', 'bearer', 'a70ba76eee6d3e0ed3a5c7c087e59bf2354604fc', 1, NULL, '803f4f84-c658-4c56-88bd-cebedf07eb24', '1c762085-be51-4d13-9ea9-881c20d1890e', NULL, NULL, 'fd8febf76e2a051cbbdea395e6ad3a927122af7eb9a50dc68f3489226817ae0f');

CREATE TABLE `oauth_authorization_code` (
  `authorization_code` varchar(256) NOT NULL,
  `expires` datetime DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  `extra` json DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `nonce` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `oauth_client` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `secret` char(36) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `url` varchar(2000) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default',
  `grant_type` varchar(255) DEFAULT NULL,
  `response_type` varchar(255) DEFAULT NULL,
  `client_type` varchar(15) DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `extra` json DEFAULT NULL,
  `token_types` varchar(2000) DEFAULT NULL,
  `jwt_secret` varchar(255) DEFAULT NULL,
  `redirect_sign_out_uri` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `oauth_client` (`id`, `name`, `description`, `secret`, `url`, `redirect_uri`, `image`, `grant_type`, `response_type`, `client_type`, `scope`, `extra`, `token_types`, `jwt_secret`, `redirect_sign_out_uri`) VALUES
('803f4f84-c658-4c56-88bd-cebedf07eb24', 'jukebox', 'Jukebox Application Registration on Keyrock', '1a5ca83e-98e0-4705-9446-d9a93d941fca', 'http://localhost', 'http://localhost/login.php', '9b93e331-8ea6-4a37-8db8-5281c1393591.png', 'authorization_code,implicit,password,client_credentials,refresh_token,hybrid', 'code,token', NULL, NULL, NULL, NULL, NULL, ''),
('idm_admin_app', 'idm', 'idm', NULL, '', '', 'default', '', '', NULL, NULL, NULL, NULL, NULL, NULL);

CREATE TABLE `oauth_refresh_token` (
  `refresh_token` varchar(256) NOT NULL,
  `expires` datetime DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `iot_id` varchar(255) DEFAULT NULL,
  `authorization_code` varchar(255) DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `oauth_refresh_token` (`refresh_token`, `expires`, `scope`, `oauth_client_id`, `user_id`, `iot_id`, `authorization_code`, `valid`) VALUES
('143e841329b9aac2e67e6e7621cb4da7390a903b', '2022-01-02 20:43:01', 'bearer', '803f4f84-c658-4c56-88bd-cebedf07eb24', 'admin', NULL, NULL, 1),
('2a0047943d8251191e9138de890259375707b035', '2022-01-03 00:59:04', 'bearer', '803f4f84-c658-4c56-88bd-cebedf07eb24', 'admin', NULL, NULL, 1),
('5fa0d66e7011f873d7b37257ee0b01dc7a8c7d57', '2022-01-03 01:27:33', 'bearer', '803f4f84-c658-4c56-88bd-cebedf07eb24', 'admin', NULL, NULL, 1),
('790751328d817a16e3da4ab46d81e76d9993d86a', '2022-01-02 20:46:19', 'bearer', '803f4f84-c658-4c56-88bd-cebedf07eb24', '1c762085-be51-4d13-9ea9-881c20d1890e', NULL, NULL, 1),
('8897880c9f3a8b20044614fe9a2c85b52ec342c6', '2022-01-02 20:45:08', 'bearer', '803f4f84-c658-4c56-88bd-cebedf07eb24', '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL, NULL, 1),
('a6775e3f96f0f7d3c2e231f88500b1d11fb2e467', '2022-01-03 01:00:33', 'bearer', '803f4f84-c658-4c56-88bd-cebedf07eb24', 'admin', NULL, NULL, 1),
('a70ba76eee6d3e0ed3a5c7c087e59bf2354604fc', '2022-01-02 23:17:58', 'bearer', '803f4f84-c658-4c56-88bd-cebedf07eb24', '1c762085-be51-4d13-9ea9-881c20d1890e', NULL, NULL, 1),
('b1c17df6ee574b8a8d3b46ea6a491264cfafeed7', '2022-01-02 23:17:46', 'bearer', '803f4f84-c658-4c56-88bd-cebedf07eb24', '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL, NULL, 1),
('c881ac906ea55b7ab0c3b34416380cbe475d106c', '2022-01-03 01:27:40', 'bearer', '803f4f84-c658-4c56-88bd-cebedf07eb24', '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', NULL, NULL, 1),
('ccb417dd4cc9b07795df930ea25e9d241dbebe2f', '2022-01-02 23:13:40', 'bearer', '803f4f84-c658-4c56-88bd-cebedf07eb24', 'admin', NULL, NULL, 1),
('e58b00840b49513990dff69619c855caa2a98ddd', '2022-01-03 00:58:04', 'bearer', '803f4f84-c658-4c56-88bd-cebedf07eb24', 'admin', NULL, NULL, 1);

CREATE TABLE `oauth_scope` (
  `id` int(11) NOT NULL,
  `scope` varchar(255) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `organization` (
  `id` varchar(36) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `description` text,
  `website` varchar(2000) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `pep_proxy` (
  `id` varchar(255) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pep_proxy` (`id`, `password`, `oauth_client_id`, `salt`) VALUES
('pep_proxy_f49e9df7-e0c4-46a8-bb3b-bb9305fc4e8e', '3a7bef6a105f19f8fa5606c3b9e1e7263bf05cc6', '803f4f84-c658-4c56-88bd-cebedf07eb24', 'd5cb866608434eae');

CREATE TABLE `permission` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `is_internal` tinyint(1) DEFAULT '0',
  `action` varchar(255) DEFAULT NULL,
  `resource` varchar(255) DEFAULT NULL,
  `xml` text,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `is_regex` tinyint(1) NOT NULL DEFAULT '0',
  `authorization_service_header` varchar(255) DEFAULT NULL,
  `use_authorization_service_header` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `permission` (`id`, `name`, `description`, `is_internal`, `action`, `resource`, `xml`, `oauth_client_id`, `is_regex`, `authorization_service_header`, `use_authorization_service_header`) VALUES
('1', 'Get and assign all internal application roles', NULL, 1, NULL, NULL, NULL, 'idm_admin_app', 0, NULL, 0),
('2', 'Manage the application', NULL, 1, NULL, NULL, NULL, 'idm_admin_app', 0, NULL, 0),
('3', 'Manage roles', NULL, 1, NULL, NULL, NULL, 'idm_admin_app', 0, NULL, 0),
('4', 'Manage authorizations', NULL, 1, NULL, NULL, NULL, 'idm_admin_app', 0, NULL, 0),
('5', 'Get and assign all public application roles', NULL, 1, NULL, NULL, NULL, 'idm_admin_app', 0, NULL, 0),
('6', 'Get and assign only public owned roles', NULL, 1, NULL, NULL, NULL, 'idm_admin_app', 0, NULL, 0);

CREATE TABLE `ptp` (
  `id` int(11) NOT NULL,
  `previous_job_id` varchar(255) NOT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `role` (
  `id` varchar(36) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `is_internal` tinyint(1) DEFAULT '0',
  `oauth_client_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `role` (`id`, `name`, `is_internal`, `oauth_client_id`) VALUES
('provider', 'Provider', 1, 'idm_admin_app'),
('purchaser', 'Purchaser', 1, 'idm_admin_app');

CREATE TABLE `role_assignment` (
  `id` int(11) NOT NULL,
  `role_organization` varchar(255) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `role_id` varchar(36) DEFAULT NULL,
  `organization_id` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `role_assignment` (`id`, `role_organization`, `oauth_client_id`, `role_id`, `organization_id`, `user_id`) VALUES
(2, NULL, '803f4f84-c658-4c56-88bd-cebedf07eb24', 'provider', NULL, 'admin');

CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL,
  `role_id` varchar(36) DEFAULT NULL,
  `permission_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `role_permission` (`id`, `role_id`, `permission_id`) VALUES
(1, 'provider', '1'),
(2, 'provider', '2'),
(3, 'provider', '3'),
(4, 'provider', '4'),
(5, 'provider', '5'),
(6, 'provider', '6'),
(7, 'purchaser', '5');

CREATE TABLE `role_usage_policy` (
  `id` int(11) NOT NULL,
  `role_id` varchar(36) DEFAULT NULL,
  `usage_policy_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `SequelizeMeta` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `SequelizeMeta` (`name`) VALUES
('201802190000-CreateUserTable.js'),
('201802190003-CreateUserRegistrationProfileTable.js'),
('201802190005-CreateOrganizationTable.js'),
('201802190008-CreateOAuthClientTable.js'),
('201802190009-CreateUserAuthorizedApplicationTable.js'),
('201802190010-CreateRoleTable.js'),
('201802190015-CreatePermissionTable.js'),
('201802190020-CreateRoleAssignmentTable.js'),
('201802190025-CreateRolePermissionTable.js'),
('201802190030-CreateUserOrganizationTable.js'),
('201802190035-CreateIotTable.js'),
('201802190040-CreatePepProxyTable.js'),
('201802190045-CreateAuthZForceTable.js'),
('201802190050-CreateAuthTokenTable.js'),
('201802190060-CreateOAuthAuthorizationCodeTable.js'),
('201802190065-CreateOAuthAccessTokenTable.js'),
('201802190070-CreateOAuthRefreshTokenTable.js'),
('201802190075-CreateOAuthScopeTable.js'),
('20180405125424-CreateUserTourAttribute.js'),
('20180612134640-CreateEidasTable.js'),
('20180727101745-CreateUserEidasIdAttribute.js'),
('20180730094347-CreateTrustedApplicationsTable.js'),
('20180828133454-CreatePasswordSalt.js'),
('20180921104653-CreateEidasNifColumn.js'),
('20180922140934-CreateOauthTokenType.js'),
('20181022103002-CreateEidasTypeAndAttributes.js'),
('20181108144720-RevokeToken.js'),
('20181113121450-FixExtraAndScopeAttribute.js'),
('20181203120316-FixTokenTypesLength.js'),
('20190116101526-CreateSignOutUrl.js'),
('20190316203230-CreatePermissionIsRegex.js'),
('20190429164755-CreateUsagePolicyTable.js'),
('20190507112246-CreateRoleUsagePolicyTable.js'),
('20190507112259-CreatePtpTable.js'),
('20191019153205-UpdateUserAuthorizedApplicationTable.js'),
('20200107102154-CreatePermissionFiwareService.js'),
('20200107102154-CreatePermissionUseFiwareService.js'),
('20200928134556-AddDisable2faKey.js'),
('20210422214057-init-visible_attributes.js'),
('20210423161823-AddOidcNonce.js.js'),
('20210603073911-hashed-access-tokens.js'),
('20210607162019-CreateDelegationEvidenceTable.js');

CREATE TABLE `trusted_application` (
  `id` int(11) NOT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `trusted_oauth_client_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `usage_policy` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` enum('COUNT_POLICY','AGGREGATION_POLICY','CUSTOM_POLICY') DEFAULT NULL,
  `parameters` json DEFAULT NULL,
  `punishment` enum('KILL_JOB','UNSUBSCRIBE','MONETIZE') DEFAULT NULL,
  `from` time DEFAULT NULL,
  `to` time DEFAULT NULL,
  `odrl` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `oauth_client_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
  `id` varchar(36) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `description` text,
  `website` varchar(2000) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default',
  `gravatar` tinyint(1) DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `date_password` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '0',
  `admin` tinyint(1) DEFAULT '0',
  `extra` json DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `starters_tour_ended` tinyint(1) DEFAULT '0',
  `eidas_id` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `username`, `description`, `website`, `image`, `gravatar`, `email`, `password`, `date_password`, `enabled`, `admin`, `extra`, `scope`, `starters_tour_ended`, `eidas_id`, `salt`) VALUES
('109d97f8-e3f9-4a43-bfc9-d5a1bc5579eb', 'jsimpson', 'Jonathan Simpson', 'ORGANIZER', 'default', 0, 'jsimpson@test.com', '4b6fd49db2afddca4c1851b65a3aeba87eae99aa', '2021-12-07 15:39:15', 1, 0, NULL, NULL, 0, NULL, 'dac14c0f682c7d2b'),
('1c762085-be51-4d13-9ea9-881c20d1890e', 'lanthony', 'Lily Anthonys', 'ORGANIZER', 'default', 0, 'lanthony@test.com', '290648fff01e95f93ee9bdfbaa680bc43415b9a5', '2021-12-07 15:42:27', 1, 0, NULL, NULL, 0, NULL, '36094f2e8b7fac61'),
('53c2dde8-36af-4df2-be39-1f961de28dad', 'jkearns', 'Jameson Kearns', 'USER', 'default', 0, 'jkearns@test.com', 'b98850baa41ee84269571a2158747f2dcbd0e120', '2021-12-07 15:35:19', 1, 0, NULL, NULL, 0, NULL, '9070da2d57f33949'),
('78760423-2569-4c62-bc0a-ca76e39cdf4b', 'pmcdonald', 'Paula McDonald', 'USER', 'default', 0, 'pmcdonald@test.com', '3e7436e38be0bf38d40cf30617d01bac811a07d2', '2021-12-07 15:38:23', 1, 0, NULL, NULL, 0, NULL, '6a76cf45ee8229ee'),
('7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', 'yvasileiou', 'Yannis Vasileiou', 'USER', 'default', 0, 'yvasileiou@test.com', '9f76523096f3466b58db73ad9d2483bb5560393c', '2021-12-06 22:51:23', 1, 0, '{\"visible_attributes\": [\"username\", \"description\", \"website\", \"identity_attributes\", \"image\", \"gravatar\"]}', NULL, 0, NULL, '84c2256089665632'),
('admin', 'admin', 'Dimitrios Petrou', 'ADMIN', 'default', 0, 'dpetrou@isc.tuc.gr', '3367bdd2d9a872e3fc486cd8160301624cf1ca21', '2021-12-06 13:53:37', 1, 1, '{\"visible_attributes\": [\"username\", \"description\"]}', NULL, 0, NULL, '424c3496632de5e4'),
('b03dbc8d-1be7-441c-9bbe-f4d3e66012fd', 'esaunders', 'Evelina Saunders', 'ORGANIZER', 'default', 0, 'esaunders@test.com', '0033de951ef602837054c7c56e3815def15b53df', '2021-12-07 15:36:05', 1, 0, NULL, NULL, 0, NULL, '835a9d4381e1cea8'),
('b5f07c98-e681-46bd-ba00-da5bc9af6c63', 'tpapadopoulos', 'Thanasis Papadopoulos', 'USER', 'default', 0, 'tpapadopoulos@test.com', '443165ffc4d3d5c139414debf9d182e69b3a3410', '2021-12-07 15:18:31', 1, 0, NULL, NULL, 0, NULL, '02e6bb7595daaf35'),
('b7720165-fdac-4294-939d-98fc0eb9955a', 'dpenn', 'Daisy Penn', 'USER', 'default', 0, 'dpenn@test.com', 'e5f856cbd7adfa971fdec303c2f9b0e9fbbb0e53', '2021-12-07 15:38:40', 1, 0, NULL, NULL, 0, NULL, 'c1e25c601a33f92d'),
('c13b5926-635c-4378-8365-8853ac7a79e2', 'hsmith', 'Henry Smith', 'ORGANIZER', 'default', 0, 'hsmith@test.com', '79b5f5750d842186c9ea1f2280e7c006e5581c62', '2021-12-07 15:34:59', 1, 0, NULL, NULL, 0, NULL, '8a4089dc6d08110a');

CREATE TABLE `user_authorized_application` (
  `id` int(11) NOT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `shared_attributes` varchar(255) DEFAULT NULL,
  `login_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_authorized_application` (`id`, `user_id`, `oauth_client_id`, `shared_attributes`, `login_date`) VALUES
(1, 'admin', '803f4f84-c658-4c56-88bd-cebedf07eb24', 'username,email', '2021-12-19 20:43:01'),
(2, '7f964ab3-f7a7-4fa9-92b8-d8a2b4f2ec58', '803f4f84-c658-4c56-88bd-cebedf07eb24', 'username,email', '2021-12-19 20:45:08'),
(3, '1c762085-be51-4d13-9ea9-881c20d1890e', '803f4f84-c658-4c56-88bd-cebedf07eb24', 'username,email', '2021-12-19 20:46:19');

CREATE TABLE `user_organization` (
  `id` int(11) NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `organization_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user_registration_profile` (
  `id` int(11) NOT NULL,
  `activation_key` varchar(255) DEFAULT NULL,
  `activation_expires` datetime DEFAULT NULL,
  `reset_key` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `verification_key` varchar(255) DEFAULT NULL,
  `verification_expires` datetime DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `disable_2fa_key` varchar(255) DEFAULT NULL,
  `disable_2fa_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_registration_profile` (`id`, `activation_key`, `activation_expires`, `reset_key`, `reset_expires`, `verification_key`, `verification_expires`, `user_email`, `disable_2fa_key`, `disable_2fa_expires`) VALUES
(1, 'glk1uly20u', '2021-12-07 22:51:23', NULL, NULL, NULL, NULL, 'yvasileiou@test.com', NULL, NULL);


ALTER TABLE `authzforce`
  ADD PRIMARY KEY (`az_domain`),
  ADD KEY `oauth_client_id` (`oauth_client_id`);

ALTER TABLE `auth_token`
  ADD PRIMARY KEY (`access_token`),
  ADD UNIQUE KEY `access_token` (`access_token`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pep_proxy_id` (`pep_proxy_id`);

ALTER TABLE `delegation_evidence`
  ADD PRIMARY KEY (`policy_issuer`,`access_subject`),
  ADD UNIQUE KEY `policy_issuer_access_subject_unique` (`policy_issuer`,`access_subject`);

ALTER TABLE `eidas_credentials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `oauth_client_id` (`oauth_client_id`);

ALTER TABLE `iot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_client_id` (`oauth_client_id`);

ALTER TABLE `oauth_access_token`
  ADD PRIMARY KEY (`hash`),
  ADD UNIQUE KEY `oauth_access_token_hash_uk` (`hash`),
  ADD KEY `oauth_client_id` (`oauth_client_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `iot_id` (`iot_id`),
  ADD KEY `refresh_token` (`refresh_token`),
  ADD KEY `authorization_code_at` (`authorization_code`);

ALTER TABLE `oauth_authorization_code`
  ADD PRIMARY KEY (`authorization_code`),
  ADD UNIQUE KEY `authorization_code` (`authorization_code`),
  ADD KEY `oauth_client_id` (`oauth_client_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `oauth_client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `oauth_refresh_token`
  ADD PRIMARY KEY (`refresh_token`),
  ADD UNIQUE KEY `refresh_token` (`refresh_token`),
  ADD KEY `oauth_client_id` (`oauth_client_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `iot_id` (`iot_id`),
  ADD KEY `authorization_code_rt` (`authorization_code`);

ALTER TABLE `oauth_scope`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `pep_proxy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_client_id` (`oauth_client_id`);

ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `oauth_client_id` (`oauth_client_id`);

ALTER TABLE `ptp`
  ADD PRIMARY KEY (`id`,`previous_job_id`),
  ADD KEY `oauth_client_id` (`oauth_client_id`);

ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `oauth_client_id` (`oauth_client_id`);

ALTER TABLE `role_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_client_id` (`oauth_client_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `permission_id` (`permission_id`);

ALTER TABLE `role_usage_policy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `usage_policy_id` (`usage_policy_id`);

ALTER TABLE `SequelizeMeta`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `name` (`name`);

ALTER TABLE `trusted_application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_client_id` (`oauth_client_id`),
  ADD KEY `trusted_oauth_client_id` (`trusted_oauth_client_id`);

ALTER TABLE `usage_policy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_client_id` (`oauth_client_id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `user_authorized_application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `oauth_client_id` (`oauth_client_id`);

ALTER TABLE `user_organization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `organization_id` (`organization_id`);

ALTER TABLE `user_registration_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`);


ALTER TABLE `oauth_scope`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ptp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `role_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `role_usage_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `trusted_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_authorized_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `user_organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_registration_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `authzforce`
  ADD CONSTRAINT `authzforce_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE;

ALTER TABLE `auth_token`
  ADD CONSTRAINT `auth_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_token_ibfk_2` FOREIGN KEY (`pep_proxy_id`) REFERENCES `pep_proxy` (`id`) ON DELETE CASCADE;

ALTER TABLE `eidas_credentials`
  ADD CONSTRAINT `eidas_credentials_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE;

ALTER TABLE `iot`
  ADD CONSTRAINT `iot_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE;

ALTER TABLE `oauth_access_token`
  ADD CONSTRAINT `authorization_code_at` FOREIGN KEY (`authorization_code`) REFERENCES `oauth_authorization_code` (`authorization_code`) ON DELETE CASCADE,
  ADD CONSTRAINT `oauth_access_token_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `oauth_access_token_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `oauth_access_token_ibfk_3` FOREIGN KEY (`iot_id`) REFERENCES `iot` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `refresh_token` FOREIGN KEY (`refresh_token`) REFERENCES `oauth_refresh_token` (`refresh_token`) ON DELETE CASCADE;

ALTER TABLE `oauth_authorization_code`
  ADD CONSTRAINT `oauth_authorization_code_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `oauth_authorization_code_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

ALTER TABLE `oauth_refresh_token`
  ADD CONSTRAINT `authorization_code_rt` FOREIGN KEY (`authorization_code`) REFERENCES `oauth_authorization_code` (`authorization_code`) ON DELETE CASCADE,
  ADD CONSTRAINT `oauth_refresh_token_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `oauth_refresh_token_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `oauth_refresh_token_ibfk_3` FOREIGN KEY (`iot_id`) REFERENCES `iot` (`id`) ON DELETE CASCADE;

ALTER TABLE `pep_proxy`
  ADD CONSTRAINT `pep_proxy_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE;

ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE;

ALTER TABLE `ptp`
  ADD CONSTRAINT `ptp_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE;

ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE;

ALTER TABLE `role_assignment`
  ADD CONSTRAINT `role_assignment_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_assignment_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_assignment_ibfk_3` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_assignment_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE;

ALTER TABLE `role_usage_policy`
  ADD CONSTRAINT `role_usage_policy_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_usage_policy_ibfk_2` FOREIGN KEY (`usage_policy_id`) REFERENCES `usage_policy` (`id`) ON DELETE CASCADE;

ALTER TABLE `trusted_application`
  ADD CONSTRAINT `trusted_application_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trusted_application_ibfk_2` FOREIGN KEY (`trusted_oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE;

ALTER TABLE `usage_policy`
  ADD CONSTRAINT `usage_policy_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE;

ALTER TABLE `user_authorized_application`
  ADD CONSTRAINT `user_authorized_application_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_authorized_application_ibfk_2` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE;

ALTER TABLE `user_organization`
  ADD CONSTRAINT `user_organization_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_organization_ibfk_2` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE;

ALTER TABLE `user_registration_profile`
  ADD CONSTRAINT `user_registration_profile_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
