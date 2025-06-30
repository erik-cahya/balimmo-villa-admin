INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `phone_number`, `password`, `reference_code`, `role`, `description`, `tagline`, `address`, `profile`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Erik Cahya Pradana', 'erikcp38@gmail.com', NULL, '089526238', '$2y$12$8wSqNxv1A/WvB8LYucKAJehpcJOkZZdSqkJy6K1.zdtqnXhWsH4rK', 'BPA-ERIK-2120', 'agent', 'Hello, im erik.. im agent property since 1992', 'Burn Your Home', NULL, 'profile-erik-cahya-pradana.jpg', 1, NULL, '2025-06-11 22:41:50', '2025-06-11 22:43:47'),
(3, 'Deva', 'deva@gmail.com', NULL, '08786025485', '$2y$12$HEadaW9QOjfB9qK6kprwd.M2wr71fDWIvspdp2elqasl3TcwTKNeK', 'BPA-DEVA-4545', 'agent', NULL, NULL, NULL, NULL, 1, NULL, '2025-06-12 02:52:01', '2025-06-12 02:52:01'),
(4, 'Jamal', 'jamal@gmail.com', NULL, '33548521', '$2y$12$95yvMbrGDnW7MkUWaIRdmes1XqudCLfrByYMYobja3TvoutmaZf86', 'BPA-JAMAL-8754', 'agent', NULL, NULL, NULL, NULL, 1, NULL, '2025-06-12 03:43:15', '2025-06-12 03:43:15');


INSERT INTO `properties` (`id`, `property_code`, `property_name`, `property_slug`, `internal_reference`, `property_description`, `region`, `sub_region`, `property_address`, `total_land_area`, `villa_area`, `pool_area`, `bedroom`, `bathroom`, `year_construction`, `year_renovated`, `type_mandate`, `type_acceptance`, `created_at`, `updated_at`) VALUES
(1, 'BLM-7116713047', 'Grand Villa Resort Bali', 'grand-villa-resort-bali', 'BPA-ERIK-2120', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae minima, assumenda odit tenetur eligendi quos vel blanditiis nemo debitis laudantium est explicabo unde accusamus eos nesciunt. Praesentium eveniet voluptate nihil mollitia, similique molestiae enim culpa animi voluptas, repudiandae error aperiam sint fugit blanditiis provident quam saepe alias repellendus adipisci? Eaque, nihil optio iusto temporibus officiis, quasi culpa aut illo explicabo corrupti sed cum, reiciendis nemo consequuntur tenetur expedita. Repellendus laborum, voluptates quisquam illo reprehenderit nam nostrum fuga aliquid, molestias reiciendis at, officiis ea explicabo placeat! Ducimus fugit cumque recusandae, in animi error fugiat alias eaque impedit nam numquam, quaerat sequi, voluptate expedita? At voluptatem architecto repellat odio minima fuga vel nisi officia, dolorum quas quasi, inventore quia cupiditate, eos quo tempora odit. Perferendis, laborum error officia commodi tempore laboriosam sapiente? Ipsum illo unde fugiat ad corrupti deleniti veritatis. Voluptate iste commodi ratione, nisi in quas itaque at deleniti amet sequi vitae! Incidunt voluptates accusamus quia porro sequi iusto necessitatibus similique quibusdam impedit mollitia dolorum vel nisi aliquid qui aliquam itaque ea laboriosam officiis recusandae explicabo, natus quasi? Repudiandae quibusdam voluptate ullam, fugit nesciunt vero, optio alias laudantium mollitia, quisquam sint temporibus obcaecati omnis in ex velit esse! Temporibus, sed id.', 'Badung', 'Nusa Dua', 'Monkey Forest Ubud', 320.00, 254.00, 32.00, 32, 32, '2022', '2023', 'Essentials Mandate', 'accept', '2025-06-11 22:46:25', '2025-06-11 22:46:25'),
(2, 'BLM-9313425685', 'Villa Agung', 'villa-agung', 'BPM-MASTER-3213', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Badung', 'Kuta', 'Jl Raya Kuta No 44', 500.00, 400.00, 50.00, 5, 5, '2024', '2024', 'Essentials Mandate', 'accept', '2025-06-12 03:16:57', '2025-06-12 03:19:36'),
(3, 'BLM-3644600055', 'Villa Cempaka', 'villa-cempaka', 'BPA-DEVA-4545', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'Badung', 'Canggu', 'Jl Raya Canggu No 53', 600.00, 450.00, 35.00, 4, 4, '2020', '2021', 'Essentials Mandate', 'accept', '2025-06-12 03:26:43', '2025-06-12 03:34:15'),
(4, 'BLM-3926981456', 'Villa Coeur Anaya', 'villa-coeur-anaya', 'BPA-DEVA-4545', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'Tabanan', 'Bedugul', 'Jl Raya Bedugul No 32', 600.00, 400.00, 25.00, 3, 3, '2024', '2025', 'Essentials Mandate', 'accept', '2025-06-12 03:42:08', '2025-06-12 03:49:04'),
(5, 'BLM-2433125507', 'Villa Devinci', 'villa-devinci', 'BPA-JAMAL-8754', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'Badung', 'Canggu', 'Jl Raya Canggu No 97', 500.00, 450.00, 25.00, 4, 4, '2019', '2020', 'Booster Mandate', 'accept', '2025-06-12 03:48:54', '2025-06-12 03:49:45');

INSERT INTO `property_financial` (`id`, `properties_id`, `avg_nightly_rate`, `avg_occupancy_rate`, `months_rented`, `annual_turnover`, `selling_price_idr`, `selling_price_usd`, `commision_ammount_idr`, `commision_ammount_usd`, `net_seller_idr`, `net_seller_usd`, `created_at`, `updated_at`) VALUES
(1, 1, 2300000, 10.00, 10, 4000000, 450000000000, 27653507.69, 11250000000, 691337.69, 438750000000, 26962170.00, '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(2, 2, 4000000, 5.00, 8, 3000000, 36000000000, 2212752.46, 1080000000, 66382.57, 34920000000, 2146369.89, '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(3, 3, 5000000, 6.00, 10, 4500000, 4900000000, 301180.20, 245000000, 15059.01, 4655000000, 286121.19, '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(4, 4, 10000000, 9.00, 5, 7500000, 4900000000, 301180.20, 245000000, 15059.01, 4655000000, 286121.19, '2025-06-12 03:42:08', '2025-06-12 03:47:01'),
(5, 5, 5000000, 7.00, 3, 4500000, 4900000000, 301180.20, 245000000, 15059.01, 4655000000, 286121.19, '2025-06-12 03:48:54', '2025-06-12 03:48:54');

INSERT INTO `property_gallery` (`id`, `properties_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'deskripsi', '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(2, 2, 'deskripsi', '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(3, 3, 'deskripsi', '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(4, 4, 'deskripsi', '2025-06-12 03:42:08', '2025-06-12 03:42:08'),
(5, 5, 'deskripsi', '2025-06-12 03:48:54', '2025-06-12 03:48:54');

INSERT INTO `property_gallery_image` (`id`, `gallery_id`, `image_path`, `caption`, `order`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin/gallery/grand-villa-resort-bali/8be816b7-4995-4e70-b7ba-c66a645209dc.jpg', NULL, 0, 1, '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(2, 1, 'admin/gallery/grand-villa-resort-bali/eca9aeca-c698-42ca-9b3d-4694589d8367.jpg', NULL, 1, 0, '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(3, 1, 'admin/gallery/grand-villa-resort-bali/5f73a045-57da-4605-a995-eb94fa2c94b2.jpg', NULL, 2, 0, '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(4, 1, 'admin/gallery/grand-villa-resort-bali/f3f642df-ba8e-43aa-aa5d-7b39a7d50287.jpg', NULL, 3, 0, '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(5, 1, 'admin/gallery/grand-villa-resort-bali/da8b8fd6-80f5-46b4-8797-f089a5655ff2.jpg', NULL, 4, 0, '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(6, 1, 'admin/gallery/grand-villa-resort-bali/c90b9990-6ccb-41f6-a61c-1d392906f8af.jpg', NULL, 5, 0, '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(7, 1, 'admin/gallery/grand-villa-resort-bali/15fc6025-54c9-4e36-885b-1516224629b0.jpg', NULL, 6, 0, '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(8, 1, 'admin/gallery/grand-villa-resort-bali/c42e65ce-1f02-455a-97f7-62135144bffa.jpg', NULL, 7, 0, '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(9, 1, 'admin/gallery/grand-villa-resort-bali/9ddbeb8a-1110-4bbc-a7ac-18826db51178.jpg', NULL, 8, 0, '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(10, 2, 'admin/gallery/villa-agung/e0bd7714-5fbd-414f-8eb9-be59bd98d2fa.jpg', NULL, 0, 1, '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(11, 2, 'admin/gallery/villa-agung/586aeed9-c759-4436-a031-94ffdcfe8e86.jpg', NULL, 1, 0, '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(12, 2, 'admin/gallery/villa-agung/5920c33a-55b0-491a-8c81-5c84f5f4ee47.jpg', NULL, 2, 0, '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(13, 2, 'admin/gallery/villa-agung/88a0b15d-9837-404b-a4a8-758a04c3c094.jpg', NULL, 3, 0, '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(14, 2, 'admin/gallery/villa-agung/0c5008db-3e03-42a1-b24d-8a9a8f92d801.jpg', NULL, 4, 0, '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(15, 2, 'admin/gallery/villa-agung/79bc08d4-6054-4866-bb45-708fdcd2135c.jpg', NULL, 5, 0, '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(16, 2, 'admin/gallery/villa-agung/5c3e20cb-ff8f-4b77-9406-7218268a5416.jpg', NULL, 6, 0, '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(17, 3, 'admin/gallery/villa-cempaka/82953d01-f1ea-4de6-8590-5a3322a487ef.jpg', NULL, 0, 1, '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(18, 3, 'admin/gallery/villa-cempaka/1b5c6b87-f3dc-45a2-902d-e857b210322c.jpg', NULL, 1, 0, '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(19, 3, 'admin/gallery/villa-cempaka/fcfc2710-252c-42b8-a000-f93dc7c707fa.jpg', NULL, 2, 0, '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(20, 3, 'admin/gallery/villa-cempaka/9af3f7f0-c6a6-4021-b0dc-5b43c2935ecf.jpg', NULL, 3, 0, '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(21, 3, 'admin/gallery/villa-cempaka/e199d621-8882-4154-ae74-eb87f21b30d1.jpg', NULL, 4, 0, '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(22, 3, 'admin/gallery/villa-cempaka/f8684427-ee86-4b14-8ba4-d8462e07bfe8.jpg', NULL, 5, 0, '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(23, 3, 'admin/gallery/villa-cempaka/c71bbbad-08a2-49f0-b903-c6da3a192aa6.jpg', NULL, 6, 0, '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(24, 3, 'admin/gallery/villa-cempaka/6c55b54c-1ab9-46a3-a92f-ca4daa11b66d.jpg', NULL, 7, 0, '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(25, 4, 'admin/gallery/villa-coeur-anaya/08f7fb6a-3a45-4b79-ab5d-da312d583cd1.jpg', NULL, 0, 1, '2025-06-12 03:42:08', '2025-06-12 03:42:08'),
(26, 4, 'admin/gallery/villa-coeur-anaya/421f63d1-fa67-41d8-bcd7-e1029ca993fc.jpg', NULL, 1, 0, '2025-06-12 03:42:08', '2025-06-12 03:42:08'),
(27, 4, 'admin/gallery/villa-coeur-anaya/41c805bb-e141-43c9-b116-894c7292ddff.jpg', NULL, 2, 0, '2025-06-12 03:42:08', '2025-06-12 03:42:08'),
(28, 4, 'admin/gallery/villa-coeur-anaya/c9439560-0813-41c4-ae7f-5e71c9fa35e3.jpg', NULL, 3, 0, '2025-06-12 03:42:08', '2025-06-12 03:42:08'),
(29, 4, 'admin/gallery/villa-coeur-anaya/e52ac3ce-f371-4e7e-a456-0652a6cec502.jpg', NULL, 4, 0, '2025-06-12 03:42:08', '2025-06-12 03:42:08'),
(30, 4, 'admin/gallery/villa-coeur-anaya/ac10b35e-f68d-437e-8f32-8179dc70f304.jpg', NULL, 5, 0, '2025-06-12 03:42:08', '2025-06-12 03:42:08'),
(31, 5, 'admin/gallery/villa-devinci/3ffdd9ea-7abc-4312-a732-5fd6eea3d4f2.jpg', NULL, 0, 1, '2025-06-12 03:48:54', '2025-06-12 03:48:54'),
(32, 5, 'admin/gallery/villa-devinci/37530e46-d7e1-4a00-a557-1291abb9980c.jpg', NULL, 1, 0, '2025-06-12 03:48:54', '2025-06-12 03:48:54'),
(33, 5, 'admin/gallery/villa-devinci/866c0bee-80c4-4576-bfae-1318ffeef722.jpg', NULL, 2, 0, '2025-06-12 03:48:54', '2025-06-12 03:48:54'),
(34, 5, 'admin/gallery/villa-devinci/d0987542-69bd-4d2e-89ab-b6a9dc97a3c6.jpg', NULL, 3, 0, '2025-06-12 03:48:54', '2025-06-12 03:48:54'),
(35, 5, 'admin/gallery/villa-devinci/e3c6f6f9-c475-45c7-9776-07b58146dfbb.jpg', NULL, 4, 0, '2025-06-12 03:48:54', '2025-06-12 03:48:54'),
(36, 5, 'admin/gallery/villa-devinci/1c6d9215-84d5-4047-889d-278bc59bbf11.jpg', NULL, 5, 0, '2025-06-12 03:48:54', '2025-06-12 03:48:54');



INSERT INTO `property_legal` (`id`, `properties_id`, `company_name`, `rep_first_name`, `rep_last_name`, `phone`, `email`, `legal_status`, `holder_name`, `holder_number`, `start_date`, `end_date`, `purchase_date`, `extension_cost`, `purchase_cost`, `deadline_payment`, `zoning`, `created_at`, `updated_at`) VALUES
(1, 1, 'PT. PROPERT INDONESIA MADJU', 'Cahya Pradana', 'Erik', '312930120', 'erikcp38@gmail.com', 'Freehold', 'Erik CAHYAAAAA', 'CN-9302490930290', NULL, NULL, '2025-06-12', '0', '0', NULL, 'Green Zone', '2025-06-11 22:46:25', '2025-06-11 22:46:25'),
(2, 2, 'Putri Sejati', 'Jelata', 'Rkayt', '087562145', 'rtay@gmail.com', 'Leasehold', 'Deva', '3442341', '2025-06-11', '2025-06-26', NULL, '200000000', '500000000', '2025-06-19', 'Yellow Zone', '2025-06-12 03:16:57', '2025-06-12 03:16:57'),
(3, 3, 'Murni Cinta Kasih', 'Ruski', 'Jayabadi', '084215585', 'murni@gmail.com', 'Freehold', 'Retnais', '500445', NULL, NULL, '2025-06-08', '0', '0', NULL, 'Pink Zone', '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(4, 4, 'Burmina', 'Gogo', 'Rismana', '0875431165', 'gogo@gmail.com', 'Leasehold', 'Ratniasih', '5644433', '2025-05-20', '2025-05-20', NULL, 'IDR 5,000,000', 'IDR 2,500,000', '2025-05-20', 'Yellow Zone', '2025-06-12 03:42:08', '2025-06-12 03:47:01'),
(5, 5, 'PT Botol Minum', 'Tutri', 'Ksih', '33548515', 'kasih@gmail.com', 'Freehold', 'Deva', '232132', NULL, NULL, '2025-06-02', '0', '0', NULL, 'Pink Zone', '2025-06-12 03:48:54', '2025-06-12 03:48:54');

INSERT INTO `property_owner` (`id`, `properties_id`, `first_name`, `last_name`, `phone`, `email`, `owner_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Erik', 'Cahya Pradana', '089123891239', 'erikcp38@gmail.com', '1', '2025-06-11 22:46:25', '2025-06-11 22:46:25'),
(2, 2, 'Fitri', 'Akbar', '32232321', 'fitri@gmail.com', '1', '2025-06-12 03:16:57', '2025-06-12 03:16:57'),
(3, 3, 'Retno', 'Gunawan', '087564125', 'retno@gmail.com', '1', '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(4, 3, 'Juju', 'Kasih', '084521655', 'juju@gmail.com', '2', '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(5, 4, 'Cakur', 'Kukrs', '08751234', 'cakur@gmail.com', '1', '2025-06-12 03:42:08', '2025-06-12 03:47:01'),
(6, 5, 'Cakra', 'Urima', '087455214', 'cakra@gmail.com', '1', '2025-06-12 03:48:54', '2025-06-12 03:48:54');



INSERT INTO `property_url_attachment` (`id`, `properties_id`, `name`, `path_attachment`, `created_at`, `updated_at`) VALUES
(1, 1, 'url_virtual_tour', 'https://www.youtube.com/watch?v=b54ApFn_Jgg', '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(2, 1, 'url_lifestyle', 'https://www.youtube.com/watch?v=vy-1ebPEw2A&pp=ygUHYmFsaW1tbw%3D%3D', '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(3, 1, 'url_experience', 'https://www.youtube.com/watch?v=TyAwNhvUI7k&amp;pp=ygUHYmFsaW1tbw%3D%3D', '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(4, 1, 'file_rental_support', 'Type Mandate.pdf', '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(5, 1, 'file_type_of_mandate', NULL, '2025-06-11 22:46:26', '2025-06-11 22:46:26'),
(6, 2, 'url_virtual_tour', 'https://youtu.be/zABLecsR5UE?si=FoxWH0-R85fMSAKl', '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(7, 2, 'url_lifestyle', 'https://youtu.be/JENpTmMQBQY?si=iEAbUTBrXYFf_O1F', '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(8, 2, 'url_experience', 'https://youtu.be/S0Kez6MERGE?si=c75eBbvTevc2EASf', '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(9, 2, 'file_rental_support', 'Plan de paiment Projection Juin 2025.xlsx', '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(10, 2, 'file_type_of_mandate', 'site balimmo.docx', '2025-06-12 03:16:58', '2025-06-12 03:16:58'),
(11, 3, 'url_virtual_tour', 'https://youtu.be/X_44526J0ik?si=rXhrcGJY_R_QpF4G', '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(12, 3, 'url_lifestyle', 'https://youtu.be/JENpTmMQBQY?si=iEAbUTBrXYFf_O1F', '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(13, 3, 'url_experience', 'https://youtu.be/X_44526J0ik?si=rXhrcGJY_R_QpF4G', '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(14, 3, 'file_rental_support', 'denah.png', '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(15, 3, 'file_type_of_mandate', 'La Villa Agung est une villa une chambre pensée pour conjuguer confort moderne.docx', '2025-06-12 03:26:43', '2025-06-12 03:26:43'),
(16, 4, 'url_virtual_tour', 'https://youtu.be/zABLecsR5UE?si=FoxWH0-R85fMSAKl', '2025-06-12 03:42:08', '2025-06-12 03:42:08'),
(17, 4, 'url_lifestyle', 'https://youtu.be/X_44526J0ik?si=rXhrcGJY_R_QpF4G', '2025-06-12 03:42:08', '2025-06-12 03:42:08'),
(18, 4, 'url_experience', 'https://youtu.be/X_44526J0ik?si=rXhrcGJY_R_QpF4G', '2025-06-12 03:42:08', '2025-06-12 03:42:08'),
(19, 4, 'file_rental_support', 'img1.jpg', '2025-06-12 03:42:08', '2025-06-12 03:42:08'),
(20, 4, 'file_type_of_mandate', 'img10.jpg', '2025-06-12 03:42:08', '2025-06-12 03:42:08'),
(21, 5, 'url_virtual_tour', 'https://youtu.be/X_44526J0ik?si=rXhrcGJY_R_QpF4G', '2025-06-12 03:48:54', '2025-06-12 03:48:54'),
(22, 5, 'url_lifestyle', 'https://youtu.be/X_44526J0ik?si=rXhrcGJY_R_QpF4G', '2025-06-12 03:48:54', '2025-06-12 03:48:54'),
(23, 5, 'url_experience', 'https://youtu.be/X_44526J0ik?si=rXhrcGJY_R_QpF4G', '2025-06-12 03:48:54', '2025-06-12 03:48:54'),
(24, 5, 'file_rental_support', 'img10.jpg', '2025-06-12 03:48:54', '2025-06-12 03:48:54'),
(25, 5, 'file_type_of_mandate', 'denah.png', '2025-06-12 03:48:54', '2025-06-12 03:48:54');