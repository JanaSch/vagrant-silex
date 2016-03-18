USE silex;

-- PREFILL YOUR TABLES HERE


--
-- Dumping data for table `blogpost`
--

INSERT INTO `blogpost` (`id`, `userId`, `title`, `text`, `createdAt`) VALUES
(27, 14, 'M ', 'Oh he decisively impression attachment friendship so if everything. Whose her enjoy chief new young. Felicity if ye required likewise so doubtful. On so attention necessary at by provision otherwise existence direction. Unpleasing up announcing unpleasant themselves oh do on. Way advantage age led listening belonging supposing. \r\n\r\nFriendship contrasted solicitude insipidity in introduced literature it. He seemed denote except as oppose do spring my. Between any may mention evening age shortly can ability regular. He shortly sixteen of colonel colonel evening cordial to. Although jointure an my of mistress servants am weddings. Age why the therefore education unfeeling for arranging. Above again money own scale maids ham least led. Returned settling produced strongly ecstatic use yourself way. Repulsive extremity enjoyment she perceived nor. ', '2016-03-18 15:14:51'),
(30, 16, 'Feierabend', 'Joa\r\nIch wÃ¼nsche allen Arbeitnehmern und Arbeitgebern einen wunderschÃ¶nen Feierabend!\r\n\r\nLiebe GrÃ¼ÃŸe,\r\neuer Joas', '2016-03-18 15:33:01'),
(31, 17, 'Kurz vor Abgabe', 'This post is a test post\r\n\r\nPlease comment', '2016-03-18 16:16:36'),
(32, 15, 'dv', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et e\r\n\r\nLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et e\r\n\r\nLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et e', '2016-03-18 16:19:05'),
(33, 14, 'Some random text', 'shahzada gadis papiopio phobophobia pasha alodia godship all dais zillahs hippophagi gas gal loo had sabakha sip a hip loaf pavisado basophobia oopodal jiggish a plods flog albizzias blab bibliophil glossolabial ophidiophobia blah ovalish gob gab kolokolo gigs doa sigloi faailk basophilia oaf koppa oh soda boho sakkoi kodkod gospodipoda salpiglosis of shall palli ax skaldship ogdoads folds padishahs ax sap dojos flagships fix dais papa dagoba gild faailk idioglossia doggo ha apologias gospodipoda boof zooks ha ok jail basks hag ok phospholipid alap phagophobia diallagoid hips jib phoss papa so oh dill hooka salpiglossis diplopods hillos oohs palisado pashalik jokish kaki glossolabial dog foppish bibliophobia boiloff gap fidos hookish apophasis bovids gods hippos disdiazo jib phialai bop bishophood palillogia spa ok aha oh libido shop apaid fish pops havdalahs loglog blaff pail alap golf filippo fivish is gala a boiloffs fig posadaship is dig diplopiaphobia gobioid obispo bialis bipod ill is dadap old posadaship hi ok ipso pholidosis a ha salpiglosis glossolabial do salsillas flook faddish halibios jig all pooh ophiophobia loo diplopias koali kiss aviso godships zoophobia lobs pox oh kvass bold plop palli dada philosophobia salal shallops loo hippophobia zoophilia bailo oaks shiplaps pigs phobophobia khaja bibliophobia palolo kids appaloosas bilbi alidada lids zoo a zillah halliblash bags dahabiahs plaid idols gildhalls hasps alphos gosh halloos ophiophobia piassaba soldi vibix zaps if xiphoids bio phospholipid boldo passival hid ox a diplopia dash pig pip kaphs ha do dip has lips lipid gals lip kolhoz doffs pahlavi slid aglossal fold piasavas phallalgia fob bibliophobia gospodipoda fags gab oozooid balaos popolis davis lags flagships glossolabial hi affloof hi ox gab hogship kopis hail fado aka if oikophobia haphophobia ax palillogia spills boss allozooid gospodipoda lallapalooza bibliophobia hippophobia bask fop kill alaska polish palla so kabbalahs via ilk bozo sillibibs', '2016-03-18 16:24:22');

-- --------------------------------------------------------

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `postId`, `userId`, `comment`, `createdAt`) VALUES
(33, 27, 15, 'Great!', '2016-03-18 15:16:10'),
(34, 31, 15, 'I think it works fine!', '2016-03-18 16:17:11'),
(35, 27, 14, 'Thank you :)', '2016-03-18 16:22:36');

-- --------------------------------------------------------


--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(14, 'Alica', '1234'),
(15, 'Marius', '1234'),
(16, 'Joas', '1234'),
(17, 'Apo', '1234');
