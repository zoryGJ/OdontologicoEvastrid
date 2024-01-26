-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 26, 2024 at 03:36 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smile`
--

-- --------------------------------------------------------

--
-- Table structure for table `administradores`
--

CREATE TABLE `administradores` (
  `codigo` bigint NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `cargo` varchar(60) NOT NULL,
  `clave` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `administradores`
--

INSERT INTO `administradores` (`codigo`, `nombres`, `apellidos`, `email`, `cargo`, `clave`) VALUES
(7, 'Evastrid', 'Pardo', 'evastridpardo@gmail.com', 'Dueña', '$2y$10$R4fLauAN7zEL/wa1Qy1KDu8nWlFINHxNSZUEYpYNJOIY3GsJ65aLe');

-- --------------------------------------------------------

--
-- Table structure for table `antecedentes_familiares`
--

CREATE TABLE `antecedentes_familiares` (
  `codigo` bigint NOT NULL,
  `lista_antecedentes_familiares` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `antecedentes_familiares`
--

INSERT INTO `antecedentes_familiares` (`codigo`, `lista_antecedentes_familiares`) VALUES
(1, 'Asma'),
(2, 'Hipertension Arterial'),
(3, 'Diabetes Mellitus'),
(4, 'Diabetes tipo 2'),
(5, 'Enfermedad Pulmonar'),
(6, 'ACV'),
(7, 'Cancer');

-- --------------------------------------------------------

--
-- Table structure for table `antecedentes_familiares_pacientes`
--

CREATE TABLE `antecedentes_familiares_pacientes` (
  `numero_documento_paciente_FK` varchar(20) NOT NULL,
  `codigo_antecedentes_familiares_FK` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `antecedentes_familiares_pacientes`
--

INSERT INTO `antecedentes_familiares_pacientes` (`numero_documento_paciente_FK`, `codigo_antecedentes_familiares_FK`) VALUES
('1121838795', 1),
('1121838795', 7),
('1997597893', 2),
('1997597893', 4);

-- --------------------------------------------------------

--
-- Table structure for table `articulaciones_temporo_mandibulares`
--

CREATE TABLE `articulaciones_temporo_mandibulares` (
  `codigo` bigint NOT NULL,
  `hallazgos_clinicos` varchar(90) NOT NULL,
  `sano` varchar(10) NOT NULL,
  `codigo_historia_clinica_FK` bigint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `articulaciones_temporo_mandibulares`
--

INSERT INTO `articulaciones_temporo_mandibulares` (`codigo`, `hallazgos_clinicos`, `sano`, `codigo_historia_clinica_FK`) VALUES
(1, 'ruidos', 'NO', 1),
(2, 'desviacion', 'NO', 1),
(3, 'cambioVolumen', 'NO', 1),
(4, 'bloqueoMandibular', 'NO', 1),
(5, 'limitacionApertura', 'NO', 1),
(6, 'dolorArticular', 'NO', 1),
(7, 'dolorMuscular', 'NO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `codigos_cies`
--

CREATE TABLE `codigos_cies` (
  `codigo` bigint NOT NULL,
  `codigo_alfa_numerico` varchar(10) NOT NULL,
  `descripcion_codigo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `codigos_cies`
--

INSERT INTO `codigos_cies` (`codigo`, `codigo_alfa_numerico`, `descripcion_codigo`) VALUES
(180, 'A690', 'ESTOMATITIS ULCERATIVA NECROTIZANTE '),
(181, 'B002', 'GINGIVOESTOMATITIS Y FARINGOAMIGDALITIS HERPETICA'),
(182, 'B084', 'ESTOMATITIS VESICULAR ENTEROVIRAL CON EXANTEMA'),
(183, 'B370', 'ESTOMATITIS CANDIDIASICA'),
(184, 'C000', 'TUMOR MALIGNO DEL LABIO SUPERIOR, CARA EXTERNA'),
(185, 'C001', 'TUMOR MALIGNO DEL LABIO INFERIOR, CARA EXTERNA'),
(186, 'C002', 'TUMOR MALIGNO DEL LABIO, CARA EXTERNA, SIN OTRA ESPECIFICACIÓN'),
(187, 'C003', 'TUMOR MALIGNO DEL LABIO SUPERIOR, CARA INTERNA'),
(188, 'C004', 'TUMOR MALIGNO DEL LABIO INFERIOR, CARA INTERNA'),
(189, 'C005', 'TUMOR MALIGNO DEL LABIO, CARA INTERNA, SIN OTRA ESPECIFICACION'),
(190, 'C006', 'TUMOR MALIGNO DE LA COMISURA LABIAL'),
(191, 'C008', 'LESION DE SITIOS CONTIGUOS DEL LABIO'),
(192, 'C009', 'TUMOR MALIGNO DEL LABIO, PARTE NO ESPECIFICADA'),
(193, 'C020', 'TUMOR MALIGNO DE LA CARA DORSAL DE LA LENGUA'),
(194, 'C021', 'TUMOR MALIGNO DEL BORDE DE LA LENGUA'),
(195, 'C022', 'TUMOR MALIGNO DE LA CARA VENTRAL DE LA LENGUA'),
(196, 'C023', 'TUMOR MALIGNO DE LOS DOS TERCIOS ANTERIORES DE LA LENGUA, PARTE NO ESPECIFICADA'),
(197, 'C024', 'TUMOR MALIGNO DE LA AMIGDALA LINGUAL'),
(198, 'C028', 'LESION DE SITIOS CONTIGUOS DE LA LENGUA'),
(199, 'C029', 'TUMOR MALIGNO DE LA LENGUA, PARTE NO ESPECIFICADA'),
(200, 'C030', 'TUMOR MALIGNO DE LA ENCIA SUPERIOR'),
(201, 'C031', 'TUMOR MALIGNO DE LA ENCIA INFERIOR'),
(202, 'C039', 'TUMOR MALIGNO DE LA ENCIA, PARTE NO ESPECIFICADA'),
(203, 'C040', 'TUMOR MALIGNO DE LA PARTE ANTERIOR DEL PISO DE LA BOCA'),
(204, 'C041', 'TUMOR MALIGNO DE LA PARTE LATERAL DEL PISO DE LA BOCA'),
(205, 'C048', 'LESION DE SITIOS CONTIGUOS DEL PISO DE LA BOCA'),
(206, 'C049', 'TUMOR MALIGNO DEL PISO DE LA BOCA, PARTE NO ESPECIFICADA'),
(207, 'C050', 'TUMOR MALIGNO DEL PALADAR DURO'),
(208, 'C051', 'TUMOR MALIGNO DEL PALADAR BLANDO'),
(209, 'C052', 'TUMOR MALIGNO DE LA UVULA'),
(210, 'C058', 'LESION DE SITIOS CONTIGUOS DEL PALADAR'),
(211, 'C059', 'TUMOR MALIGNO DEL PALADAR, PARTE NO ESPECIFICADA'),
(212, 'C060', 'TUMOR MALIGNO DE LA MUCOSA DE LA MEJILLA'),
(213, 'C061', 'TUMOR MALIGNO DEL VESTIBULO DE LA BOCA'),
(214, 'C062', 'TUMOR MALIGNO DEL AREA RETROMOLAR'),
(215, 'C068', 'LESION DE SITIOS CONTIGUOS DE OTRAS PARTES Y DE LAS NO ESPECIFICADAS DE LA BOCA'),
(216, 'C069', 'TUMOR MALIGNO DE LA BOCA, PARTE NO ESPECIFICADA'),
(217, 'C411', 'TUMOR MALIGNO DEL HUESO DEL MAXILAR INFERIOR'),
(218, 'D165', 'TUMOR BENIGNO DEL MAXILAR INFERIOR'),
(219, 'K000', 'ANODONCIA'),
(220, 'K001', 'DIENTES SUPERNUMERARIOS'),
(221, 'K002', 'ANOMALIAS DEL TAMAÑO Y DE LA FORMA DEL DIENTE'),
(222, 'K003', 'DIENTES MOTEADOS'),
(223, 'K004', 'ALTERACIONES EN LA FORMACION DENTARIA'),
(224, 'K005', 'ALTERACIONES HEREDITARIAS DE LA ESTRUCTURA DENTARIA, NO CLASIFICADAS EN OTRA PARTE'),
(225, 'K006', 'ALTERACIONES EN LA ERUPCION DENTARIA'),
(226, 'K007', 'SINDROME DE LA ERUPCION DENTARIA'),
(227, 'K008', 'OTROS TRASTORNOS DEL DESARROLLO DE LOS DIENTES'),
(228, 'K009', 'TRASTORNO DEL DESARROLLO DE LOS DIENTES, NO ESPECIFICADO'),
(229, 'K010', 'DIENTES INCLUIDOS'),
(230, 'K011', 'DIENTES IMPACTADOS'),
(231, 'K020', 'CARIES LIMITADA AL ESMALTE'),
(232, 'K021', 'CARIES DE LA DENTINA'),
(233, 'K022', 'CARIES DEL CEMENTO'),
(234, 'K023', 'CARIES DENTARIA DETENIDA'),
(235, 'K024', 'ODONTOCLASIA'),
(236, 'K028', 'OTRAS CARIES DENTALES'),
(237, 'K029', 'CARIES DENTAL, NO ESPECIFICADA'),
(238, 'K030', 'ATRICION EXCESIVA DE LOS DIENTES'),
(239, 'K031', 'ABRASION DE LOS DIENTES'),
(240, 'K032', 'EROSION DE LOS DIENTES'),
(241, 'K033', 'REABSORCION PATOLOGICA DE LOS DIENTES'),
(242, 'K034', 'HIPERCEMENTOSIS'),
(243, 'K035', 'ANQUILOSIS DENTAL'),
(244, 'K036', 'DEPOSITOS [ACRECIONES] EN LOS DIENTES'),
(245, 'K037', 'CAMBIOS POSTERUPTIVOS DEL COLOR DE LOS TEJIDOS DENTALES DUROS'),
(246, 'K038', 'OTRAS ENFERMEDADES ESPECIFICADAS DE LOS TEJIDOS DUROS DE LOS DIENTES'),
(247, 'K039', 'ENFERMEDAD NO ESPECIFICADA DE LOS TEJIDOS DENTALES DUROS'),
(248, 'K040', 'PULPITIS'),
(249, 'K041', 'NECROSIS DE LA PULPA'),
(250, 'K042', 'DEGENERACION DE LA PULPA'),
(251, 'K043', 'FORMACION ANORMAL DE TEJIDO DURO EN LA PULPA'),
(252, 'K044', 'PERIODONTITIS APICAL AGUDA ORIGINADA EN LA PULPA'),
(253, 'K045', 'PERIODONTITIS APICAL CRONICA'),
(254, 'K046', 'ABSCESO PERIAPICAL CON FISTULA'),
(255, 'K047', 'ABSCESO PERIAPICAL SIN FISTULA'),
(256, 'K048', 'QUISTE RADICULAR'),
(257, 'K049', 'OTRAS ENFERMEDADES Y LAS NO ESPECIFICADAS DE LA PULPA Y DEL TEJIDO PERIAPICAL'),
(258, 'K050', 'GINGIVITIS AGUDA'),
(259, 'K051', 'GINGIVITIS CRONICA'),
(260, 'K052', 'PERIODONTITIS AGUDA'),
(261, 'K053', 'PERIODONTITIS CRONICA'),
(262, 'K054', 'PERIODONTOSIS'),
(263, 'K055', 'OTRAS ENFERMEDADES PERIODONTALES'),
(264, 'K056', 'ENFERMEDAD DE PERIODONTO, NO ESPECIFICADA'),
(265, 'K060', 'RETRACCION GINGIVAL'),
(266, 'K061', 'HIPERPLASIA GINGIVAL'),
(267, 'K062', 'LESIONES DE LA ENCIA Y DE LA ZONA EDENTULA ASOCIADAS CON TRAUMATISMO'),
(268, 'K068', 'OTROS TRASTORNOS ESPECIFICADOS DE LA ENCIA Y DE LA ZONA EDENTULA'),
(269, 'K069', 'TRASTORNO NO ESPECIFICADO DE LA ENCIA Y DE LA ZONA EDENTULA'),
(270, 'K070', 'ANOMALIAS EVIDENTES DEL TAMAÑO DE LOS MAXILARES'),
(271, 'K071', 'ANOMALIAS DE LA RELACION MAXILOBASILAR'),
(272, 'K072', 'ANOMALIAS DE LA RELACION ENTRE LOS ARCOS DENTARIOS'),
(273, 'K073', 'ANOMALIAS DE LA POSICION DEL DIENTE'),
(274, 'K074', 'MALOCLUSION DE TIPO NO ESPECIFICADO'),
(275, 'K075', 'ANOMALIAS DENTOFACIALES FUNCIONALES'),
(276, 'K076', 'TRASTORNOS DE LA ARTICULACION TEMPOROMAXILAR'),
(277, 'K078', 'OTRAS ANOMALIAS DENTOFACIALES'),
(278, 'K079', 'ANOMALIA DENTOFACIAL, NO ESPECIFICADA'),
(279, 'K080', 'EXFOLIACION DE LOS DIENTES DEBIDA A CAUSAS SISTEMICAS'),
(280, 'K081', 'PERDIDA DE DIENTES DEBIDA A ACCIDENTE, EXTRACCION O ENFERMEDAD PERIODONTAL LOCAL'),
(281, 'K082', 'ATROFIA DE REBORDE ALVEOLAR DESDENTADO'),
(282, 'K083', 'RAIZ DENTAL RETENIDA'),
(283, 'K088', 'OTRAS AFECCIONES ESPECIFICADAS DE LOS DIENTES Y DE SUS ESTRUCTURAS DE SOSTEN'),
(284, 'K089', 'TRASTORNO DE LOS DIENTES Y DE SUS ESTRUCTURAS DE SOSTEN, NO ESPECIFICADO'),
(285, 'K090', 'QUISTES ORIGINADOS POR EL DESARROLLO DE LOS DIENTES'),
(286, 'K091', 'QUISTES DE LAS FISURAS (NO ODONTOGENICOS),'),
(287, 'K092', 'OTROS QUISTES DE LOS MAXILARES'),
(288, 'K098', 'OTROS QUISTES DE LA REGION BUCAL, NO CLASIFICADOS EN OTRA PARTE'),
(289, 'K099', 'QUISTE DE LA REGION BUCAL, SIN OTRA ESPECIFICACION'),
(290, 'K100', 'TRASTORNOS DEL DESARROLLO DE LOS MAXILARES'),
(291, 'K101', 'GRANULOMA CENTRAL DE CELULAS GIGANTES'),
(292, 'K102', 'AFECCIONES INFLAMATORIAS DE LOS MAXILARES'),
(293, 'K103', 'ALVEOLITIS DEL MAXILAR'),
(294, 'K108', 'OTRAS ENFERMEDADES ESPECIFICADAS DE LOS MAXILARES'),
(295, 'K109', 'ENFERMEDAD DE LOS MAXILARES, NO ESPECIFICADA'),
(296, 'K110', 'ATROFIA DE GLANDULA SALIVAL'),
(297, 'K111', 'HIPERTROFIA DE GLANDULA SALIVAL'),
(298, 'K112', 'SIALADENITIS'),
(299, 'K113', 'ABSCESO DE GLANDULA SALIVAL'),
(300, 'K114', 'FISTULA DE GLANDULA SALIVAL'),
(301, 'K115', 'SIALOLITIASIS'),
(302, 'K116', 'MUCOCELE DE GLANDULA SALIVAL'),
(303, 'K117', 'ALTERACIONES DE LA SECRECION SALIVAL'),
(304, 'K118', 'OTRAS ENFERMEDADES DE LAS GLANDULAS SALIVALES'),
(305, 'K119', 'ENFERMEDAD DE GLANDULA SALIVAL. NO ESPECIFICADA'),
(306, 'K120', 'ESTOMATITIS AFTOSA RECURRENTE'),
(307, 'K121', 'OTRAS FORMAS DE ESTOMATITIS'),
(308, 'K122', 'CELULITIS Y ABSCESO DE BOCA'),
(309, 'K130', 'ENFERMEDADES DE LOS LABIOS'),
(310, 'K131', 'MORDEDURA DEL LABIO Y DE LA MEJILLA'),
(311, 'K132', 'LEUCOPLASIA Y OTRAS ALTERACIONES DEL EPITELIO BUCAL, INCLUYENDO LA LENGUA'),
(312, 'K133', 'LEUCOPLASIA PILOSA'),
(313, 'K134', 'GRANULOMA Y LESIONES SEMEJANTES DE LA MUCOSA BUCAL'),
(314, 'K135', 'FIBROSIS DE LA SUBMUCOSA BUCAL'),
(315, 'K136', 'HIPERPLASIA IRRITATIVA DE LA MUCOSA BUCAL'),
(316, 'K137', 'OTRAS LESIONES Y LAS NO ESPECIFICADAS DE LA MUCOSA BUCAL'),
(317, 'K140', 'GLOSITIS'),
(318, 'K141', 'LENGUA GEOGRAFICA'),
(319, 'K142', 'GLOSITIS ROMBOIDEA MEDIANA'),
(320, 'K143', 'HIPERTROFIA DE LAS PAPILAS LINGUALES'),
(321, 'K144', 'ATROFIA DE LAS PAPILAS LINGUALES'),
(322, 'K145', 'LENGUA PLEGADA'),
(323, 'K146', 'GLOSODINIA'),
(324, 'K148', 'OTRAS ENFERMEDADES DE LA LENGUA'),
(325, 'K149', 'ENFERMEDAD DE LA LENGUA, NO ESPECIFICADA'),
(326, 'Q351', 'FISURA DEL PALADAR DURO'),
(327, 'Q353', 'FISURA DEL PALADAR BLANDO'),
(328, 'Q355', 'FISURA DEL PALADAR DURO Y DEL PALADAR BLANDO'),
(329, 'Q357', 'FISURA DE LA UVULA'),
(330, 'Q359', 'FISURA DEL PALADAR, SIN OTRA ESPECIFICACION'),
(331, 'Q360', 'LABIO LEPORINO, BILATERAL'),
(332, 'Q361', 'LABIO LEPORINO, LINEA MEDIA'),
(333, 'Q369', 'LABIO LEPORINO, UNILATERAL'),
(334, 'Q370', 'FISURA DEL PALADAR DURO CON LABIO LEPORINO BILATERAL'),
(335, 'Q371', 'FISURA DEL PALADAR DURO CON LABIO LEPORINO UNILATERAL'),
(336, 'Q372', 'FISURA DEL PALADAR BLANDO CON LABIO LEPORINO BILATERAL'),
(337, 'Q373', 'FISURA DEL PALADAR BLANDO CON LABIO LEPORINO UNILATERAL'),
(338, 'Q374', 'FISURA DEL PALADAR DURO Y DEL PALADAR BLANDO CON LABIO LEPORINO BILATERAL'),
(339, 'Q375', 'FISURA DEL PALADAR DURO Y DEL PALADAR BLANDO CON LABIO LEPORINO UNILATERAL'),
(340, 'Q378', 'FISURA DEL PALADAR CON LABIO LEPORINO BILATERAL, SIN OTRA ESPECIFICACION'),
(341, 'Q379', 'FISURA DEL PALADAR CON LABIO LEPORINO UNILATERAL, SIN OTRA ESPECIFICACION'),
(342, 'Q380', 'MALFORMACIONES CONGENITAS DE LOS LABIOS, NO CLASIFICADAS EN OTRA PARTE'),
(343, 'Q381', 'ANQUILOGLOSIA'),
(344, 'Q382', 'MACROGLOSIA'),
(345, 'Q383', 'OTRAS MALFORMACIONES CONGENITAS DE LA LENGUA'),
(346, 'Q384', 'MALFORMACIONES CONGENITAS DE LAS GLANDULAS Y DE LOS CONDUCTOS SALIVALES'),
(347, 'Q385', 'MALFORMACIONES CONGENITAS DEL PALADAR, NO CLASIFICADAS EN OTRA PARTE'),
(348, 'Q386', 'OTRAS MALFORMACIONES CONGENITAS DE LA BOCA'),
(349, 'R682', 'BOCA SECA, NO ESPECIFICADA'),
(350, 'S030', 'LUXACION DEL MAXILAR'),
(351, 'S032', 'LUXACION DE DIENTE'),
(352, 'S024', 'FRACTURA DEL MALAR Y DEL HUESO MAXILAR SUPERIOR'),
(353, 'S025', 'FRACTURA DE LOS DIENTES'),
(354, 'S026', 'FRACTURA DEL MAXILAR INFERIOR'),
(355, 'T180', 'CUERPO EXTRAÑO EN LA BOCA'),
(356, 'T280', 'QUEMADURA DE LA BOCA Y DE LA FARINGE'),
(357, 'Z012', 'EXAMEN ODONTOLOGICO'),
(358, 'Z965', 'PRESENCIA DE IMPLANTES DE RAIZ DE DIENTE Y DE MANDIBULA'),
(359, '0000', ''),
(360, '1111', 'Paciente Sano');

-- --------------------------------------------------------

--
-- Table structure for table `codigos_diagnosticos`
--

CREATE TABLE `codigos_diagnosticos` (
  `codigo_cies_FK` bigint NOT NULL,
  `codigo_tipo_diagnosticos_FK` bigint NOT NULL,
  `codigo_diagnosticos_FK` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `codigos_diagnosticos`
--

INSERT INTO `codigos_diagnosticos` (`codigo_cies_FK`, `codigo_tipo_diagnosticos_FK`, `codigo_diagnosticos_FK`) VALUES
(357, 1, 1),
(357, 2, 1),
(357, 3, 1),
(357, 4, 1),
(357, 5, 1),
(357, 6, 1),
(359, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `consultas`
--

CREATE TABLE `consultas` (
  `codigo` bigint NOT NULL,
  `fecha_consulta` date NOT NULL,
  `motivo_consulta` varchar(200) NOT NULL,
  `evolucion_estadoA` varchar(200) NOT NULL,
  `examen_estomatologico` varchar(200) NOT NULL,
  `numero_documento_paciente_FK` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `consultas`
--

INSERT INTO `consultas` (`codigo`, `fecha_consulta`, `motivo_consulta`, `evolucion_estadoA`, `examen_estomatologico`, `numero_documento_paciente_FK`) VALUES
(1, '2024-01-17', 'Consulta de cesar', 'Consulta de cesar', 'Consulta de cesar', '1121838795'),
(2, '2024-01-17', 'Consulta 2', 'Consulta 2', 'Consulta 2', '1121838795'),
(3, '2024-01-19', 'Consulta 1 de Manuel', 'Consulta 1 de Manuel', 'Consulta 1 de Manuel', '1997597893'),
(4, '2024-01-20', 'Prueba nueva convencion seccion diente', 'Prueba nueva convencion seccion diente', 'Prueba nueva convencion seccion diente', '1997597893');

-- --------------------------------------------------------

--
-- Table structure for table `convenciones`
--

CREATE TABLE `convenciones` (
  `codigo` bigint NOT NULL,
  `convencion` varchar(30) NOT NULL,
  `figura` varchar(90) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `color` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `convenciones`
--

INSERT INTO `convenciones` (`codigo`, `convencion`, `figura`, `color`) VALUES
(1, 'Exodoncia Realizada', 'Exodoncia realizada.png', 'Azul'),
(2, 'Exodoncia Simple Indicada', 'Exodoncia simple indicada.png', 'Rojo'),
(3, 'Exodoncia Quirurjica Indicada', 'Exodoncia quirurjica indicada.png', 'Rojo'),
(4, 'Sin Erupcionar', 'Sin erupcionar.png', 'Azul'),
(5, 'Endodoncia Realizada', 'Edodoncia realizada.png', 'Azul'),
(6, 'Endodoncia Indicada', 'Edodoncia indicada.png', 'Rojo'),
(7, 'Sellante Presente', 'Sellante presente.png', 'Azul'),
(8, 'Sellante Indicado', 'Sellante idicado.png', 'Rojo'),
(9, 'Erosión o Abrasión', 'Eroción o abración.png', 'Rojo'),
(10, 'Diente Sano', 'Procedimiento realizado.png', 'Azul'),
(11, 'Corona Buen Estado', 'Corona buen estado.png', 'Azul'),
(12, 'Corona Mal Estado', 'Corona mal estado.png', 'Rojo'),
(13, 'Provisional Buen Estado', 'Provicional buen estado.png', 'Azul'),
(14, 'Provisional Mal Estado', 'Provicional mal estado.png', 'Rojo'),
(15, 'Núcleo Buen Estado', 'Nucleo buen estado.png', 'Azul'),
(16, 'Núcleo Mal Estado', 'Nucleo mal estado.png', 'Rojo');

-- --------------------------------------------------------

--
-- Table structure for table `convenciones_oc`
--

CREATE TABLE `convenciones_oc` (
  `codigo` bigint NOT NULL,
  `convencion` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `convenciones_oc`
--

INSERT INTO `convenciones_oc` (`codigo`, `convencion`, `color`) VALUES
(1, 'Cariado', 'Rojo'),
(2, 'Obturado - Amalgama', 'Azul'),
(3, 'Obturado - Resina', 'Verde'),
(4, 'Amalgama - Desadaptada', 'Azul-especial'),
(5, 'Resina - Desadaptada', 'Verde-especial');

-- --------------------------------------------------------

--
-- Table structure for table `convencion_seccion`
--

CREATE TABLE `convencion_seccion` (
  `codigo` bigint NOT NULL,
  `codigo_convenciones_oc_FK` bigint NOT NULL,
  `codigo_seccion_FK` bigint NOT NULL,
  `codigo_OI_FK` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `convencion_seccion`
--

INSERT INTO `convencion_seccion` (`codigo`, `codigo_convenciones_oc_FK`, `codigo_seccion_FK`, `codigo_OI_FK`) VALUES
(1, 1, 1, 17),
(2, 2, 4, 17),
(3, 3, 1, 69),
(4, 3, 4, 69),
(5, 3, 1, 121),
(6, 3, 4, 121),
(7, 1, 5, 129),
(8, 3, 1, 173),
(9, 3, 4, 173),
(10, 3, 5, 181),
(11, 5, 1, 262),
(12, 5, 2, 262),
(13, 5, 3, 262),
(14, 5, 4, 262),
(15, 5, 5, 262),
(16, 4, 5, 263),
(17, 1, 5, 313),
(18, 5, 1, 314),
(19, 5, 2, 314),
(20, 5, 3, 314),
(21, 5, 4, 314),
(22, 5, 5, 314),
(23, 4, 5, 315),
(24, 1, 5, 365),
(25, 5, 1, 366),
(26, 5, 2, 366),
(27, 5, 3, 366),
(28, 5, 4, 366),
(29, 5, 5, 366),
(30, 4, 5, 367),
(31, 3, 1, 433),
(32, 3, 4, 433),
(33, 3, 5, 441);

-- --------------------------------------------------------

--
-- Table structure for table `departamentos`
--

CREATE TABLE `departamentos` (
  `codigo` bigint NOT NULL,
  `departamento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `departamentos`
--

INSERT INTO `departamentos` (`codigo`, `departamento`) VALUES
(5, 'ANTIOQUIA'),
(8, 'ATLÁNTICO'),
(11, 'BOGOTÁ, D.C.'),
(13, 'BOLÍVAR'),
(15, 'BOYACÁ'),
(17, 'CALDAS'),
(18, 'CAQUETÁ'),
(19, 'CAUCA'),
(20, 'CESAR'),
(23, 'CÓRDOBA'),
(25, 'CUNDINAMARCA'),
(27, 'CHOCÓ'),
(41, 'HUILA'),
(44, 'LA GUAJIRA'),
(47, 'MAGDALENA'),
(50, 'META'),
(52, 'NARIÑO'),
(54, 'NORTE DE SANTANDER'),
(63, 'QUINDIO'),
(66, 'RISARALDA'),
(68, 'SANTANDER'),
(70, 'SUCRE'),
(73, 'TOLIMA'),
(76, 'VALLE DEL CAUCA'),
(81, 'ARAUCA'),
(85, 'CASANARE'),
(86, 'PUTUMAYO'),
(88, 'ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA'),
(91, 'AMAZONAS'),
(94, 'GUAINÍA'),
(95, 'GUAVIARE'),
(97, 'VAUPÉS'),
(99, 'VICHADA');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosticos`
--

CREATE TABLE `diagnosticos` (
  `codigo` bigint NOT NULL,
  `codigo_historia_clinica_FK` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `diagnosticos`
--

INSERT INTO `diagnosticos` (`codigo`, `codigo_historia_clinica_FK`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dientes`
--

CREATE TABLE `dientes` (
  `codigo` bigint NOT NULL,
  `numero_diente` bigint NOT NULL,
  `cuadrante` bigint NOT NULL,
  `cuadrante_fila` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `dientes`
--

INSERT INTO `dientes` (`codigo`, `numero_diente`, `cuadrante`, `cuadrante_fila`) VALUES
(1, 11, 1, 1),
(2, 12, 1, 1),
(3, 13, 1, 1),
(4, 14, 1, 1),
(5, 15, 1, 1),
(6, 16, 1, 1),
(7, 17, 1, 1),
(8, 18, 1, 1),
(9, 51, 1, 2),
(10, 52, 1, 2),
(11, 53, 1, 2),
(12, 54, 1, 2),
(13, 55, 1, 2),
(14, 21, 2, 1),
(15, 22, 2, 1),
(16, 23, 2, 1),
(17, 24, 2, 1),
(18, 25, 2, 1),
(19, 26, 2, 1),
(20, 27, 2, 1),
(21, 28, 2, 1),
(22, 61, 2, 2),
(23, 62, 2, 2),
(24, 63, 2, 2),
(25, 64, 2, 2),
(26, 65, 2, 2),
(28, 81, 3, 1),
(29, 82, 3, 1),
(30, 83, 3, 1),
(31, 84, 3, 1),
(32, 85, 3, 1),
(33, 41, 3, 2),
(34, 42, 3, 2),
(35, 43, 3, 2),
(36, 44, 3, 2),
(37, 45, 3, 2),
(38, 46, 3, 2),
(39, 47, 3, 2),
(40, 48, 3, 2),
(41, 71, 4, 1),
(42, 72, 4, 1),
(43, 73, 4, 1),
(44, 74, 4, 1),
(45, 75, 4, 1),
(46, 31, 4, 2),
(47, 32, 4, 2),
(48, 33, 4, 2),
(49, 34, 4, 2),
(50, 35, 4, 2),
(51, 36, 4, 2),
(52, 37, 4, 2),
(53, 38, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `evoluciones_h_c`
--

CREATE TABLE `evoluciones_h_c` (
  `codigo` bigint NOT NULL,
  `actividad` varchar(255) NOT NULL,
  `fecha_evolucion` date NOT NULL,
  `codigo_cups` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `copago` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `descripcion_procedimiento` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `codigo_consultas_FK` bigint NOT NULL,
  `codigo_odontograma_FK` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `evoluciones_h_c`
--

INSERT INTO `evoluciones_h_c` (`codigo`, `actividad`, `fecha_evolucion`, `codigo_cups`, `copago`, `descripcion_procedimiento`, `codigo_consultas_FK`, `codigo_odontograma_FK`) VALUES
(1, 'Sanacion', '2024-01-18', '12', '123', 'Actividad de sanacion', 1, 2),
(2, 'Nueva carie', '2024-01-18', '123', '123', 'Desscripcion nueva carie', 1, 3),
(3, 'a', '2024-01-20', 'a', '1', 'a', 4, 7),
(4, 'Prueba de cups', '2024-01-20', '230101 - EXODONCIA DE DIENTE PERMANENTE UNIRRADICULAR', '0', 'Prueba de cups', 4, 8),
(5, 'Actividad', '2024-01-22', '230101 - EXODONCIA DE DIENTE PERMANENTE UNIRRADICULAR', '0', 'asdads', 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `higienes`
--

CREATE TABLE `higienes` (
  `codigo` bigint NOT NULL,
  `higieneOral` varchar(10) NOT NULL,
  `frecuencia` varchar(10) NOT NULL,
  `gradoRiesgo` varchar(10) NOT NULL,
  `sedaDental` varchar(10) NOT NULL,
  `pigmentaciones` varchar(10) NOT NULL,
  `codigo_historia_clinica_FK` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `higienes`
--

INSERT INTO `higienes` (`codigo`, `higieneOral`, `frecuencia`, `gradoRiesgo`, `sedaDental`, `pigmentaciones`, `codigo_historia_clinica_FK`) VALUES
(1, 'si', 'no', 'si', 'si', 'si', 1);

-- --------------------------------------------------------

--
-- Table structure for table `historias_clinicas`
--

CREATE TABLE `historias_clinicas` (
  `Codigo` bigint NOT NULL,
  `antecedentes_odontologicos_medicos_generales` varchar(250) DEFAULT NULL,
  `id_paciente_FK` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `historias_clinicas`
--

INSERT INTO `historias_clinicas` (`Codigo`, `antecedentes_odontologicos_medicos_generales`, `id_paciente_FK`) VALUES
(1, 'No posee antecedentes ', '1997597893');

-- --------------------------------------------------------

--
-- Table structure for table `ips`
--

CREATE TABLE `ips` (
  `codigo` bigint NOT NULL,
  `nombre_ips` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ips`
--

INSERT INTO `ips` (`codigo`, `nombre_ips`) VALUES
(1, 'Aliansalud'),
(2, 'Cafam EPS'),
(3, 'Capital Salud EPS'),
(4, 'Capresoca'),
(5, 'Colsubsidio'),
(6, 'COMFANDI'),
(7, 'Compensar'),
(8, 'Coomeva'),
(9, 'Coosalud'),
(10, 'EPS Sanitas'),
(11, 'EPS Sura'),
(12, 'Famisanar'),
(13, 'Magisterio'),
(14, 'Medimás'),
(15, 'Nueva EPS'),
(16, 'Policia Nacional'),
(17, 'Salud Total'),
(18, '1Savia Salud EPS'),
(19, 'SISBEN IV');

-- --------------------------------------------------------

--
-- Table structure for table `municipios`
--

CREATE TABLE `municipios` (
  `codigo` bigint NOT NULL,
  `municipio` varchar(80) NOT NULL,
  `codigo_departamento_FK` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `municipios`
--

INSERT INTO `municipios` (`codigo`, `municipio`, `codigo_departamento_FK`) VALUES
(1, 'Abriaquí', 5),
(2, 'Acacías', 50),
(3, 'Acandí', 27),
(4, 'Acevedo', 41),
(5, 'Achí', 13),
(6, 'Agrado', 41),
(7, 'Agua de Dios', 25),
(8, 'Aguachica', 20),
(9, 'Aguada', 68),
(10, 'Aguadas', 17),
(11, 'Aguazul', 85),
(12, 'Agustín Codazzi', 20),
(13, 'Aipe', 41),
(14, 'Albania', 18),
(15, 'Albania', 44),
(16, 'Albania', 68),
(17, 'Albán', 25),
(18, 'Albán (San José)', 52),
(19, 'Alcalá', 76),
(20, 'Alejandria', 5),
(21, 'Algarrobo', 47),
(22, 'Algeciras', 41),
(23, 'Almaguer', 19),
(24, 'Almeida', 15),
(25, 'Alpujarra', 73),
(26, 'Altamira', 41),
(27, 'Alto Baudó (Pie de Pato)', 27),
(28, 'Altos del Rosario', 13),
(29, 'Alvarado', 73),
(30, 'Amagá', 5),
(31, 'Amalfi', 5),
(32, 'Ambalema', 73),
(33, 'Anapoima', 25),
(34, 'Ancuya', 52),
(35, 'Andalucía', 76),
(36, 'Andes', 5),
(37, 'Angelópolis', 5),
(38, 'Angostura', 5),
(39, 'Anolaima', 25),
(40, 'Anorí', 5),
(41, 'Anserma', 17),
(42, 'Ansermanuevo', 76),
(43, 'Anzoátegui', 73),
(44, 'Anzá', 5),
(45, 'Apartadó', 5),
(46, 'Apulo', 25),
(47, 'Apía', 66),
(48, 'Aquitania', 15),
(49, 'Aracataca', 47),
(50, 'Aranzazu', 17),
(51, 'Aratoca', 68),
(52, 'Arauca', 81),
(53, 'Arauquita', 81),
(54, 'Arbeláez', 25),
(55, 'Arboleda (Berruecos)', 52),
(56, 'Arboledas', 54),
(57, 'Arboletes', 5),
(58, 'Arcabuco', 15),
(59, 'Arenal', 13),
(60, 'Argelia', 5),
(61, 'Argelia', 19),
(62, 'Argelia', 76),
(63, 'Ariguaní (El Difícil)', 47),
(64, 'Arjona', 13),
(65, 'Armenia', 5),
(66, 'Armenia', 63),
(67, 'Armero (Guayabal)', 73),
(68, 'Arroyohondo', 13),
(69, 'Astrea', 20),
(70, 'Ataco', 73),
(71, 'Atrato (Yuto)', 27),
(72, 'Ayapel', 23),
(73, 'Bagadó', 27),
(74, 'Bahía Solano (Mútis)', 27),
(75, 'Bajo Baudó (Pizarro)', 27),
(76, 'Balboa', 19),
(77, 'Balboa', 66),
(78, 'Baranoa', 8),
(79, 'Baraya', 41),
(80, 'Barbacoas', 52),
(81, 'Barbosa', 5),
(82, 'Barbosa', 68),
(83, 'Barichara', 68),
(84, 'Barranca de Upía', 50),
(85, 'Barrancabermeja', 68),
(86, 'Barrancas', 44),
(87, 'Barranco de Loba', 13),
(88, 'Barranquilla', 8),
(89, 'Becerríl', 20),
(90, 'Belalcázar', 17),
(91, 'Bello', 5),
(92, 'Belmira', 5),
(93, 'Beltrán', 25),
(94, 'Belén', 15),
(95, 'Belén', 52),
(96, 'Belén de Bajirá', 27),
(97, 'Belén de Umbría', 66),
(98, 'Belén de los Andaquíes', 18),
(99, 'Berbeo', 15),
(100, 'Betania', 5),
(101, 'Beteitiva', 15),
(102, 'Betulia', 5),
(103, 'Betulia', 68),
(104, 'Bituima', 25),
(105, 'Boavita', 15),
(106, 'Bochalema', 54),
(107, 'Bogotá D.C.', 11),
(108, 'Bojacá', 25),
(109, 'Bojayá (Bellavista)', 27),
(110, 'Bolívar', 5),
(111, 'Bolívar', 19),
(112, 'Bolívar', 68),
(113, 'Bolívar', 76),
(114, 'Bosconia', 20),
(115, 'Boyacá', 15),
(116, 'Briceño', 5),
(117, 'Briceño', 15),
(118, 'Bucaramanga', 68),
(119, 'Bucarasica', 54),
(120, 'Buenaventura', 76),
(121, 'Buenavista', 15),
(122, 'Buenavista', 23),
(123, 'Buenavista', 63),
(124, 'Buenavista', 70),
(125, 'Buenos Aires', 19),
(126, 'Buesaco', 52),
(127, 'Buga', 76),
(128, 'Bugalagrande', 76),
(129, 'Burítica', 5),
(130, 'Busbanza', 15),
(131, 'Cabrera', 25),
(132, 'Cabrera', 68),
(133, 'Cabuyaro', 50),
(134, 'Cachipay', 25),
(135, 'Caicedo', 5),
(136, 'Caicedonia', 76),
(137, 'Caimito', 70),
(138, 'Cajamarca', 73),
(139, 'Cajibío', 19),
(140, 'Cajicá', 25),
(141, 'Calamar', 13),
(142, 'Calamar', 95),
(143, 'Calarcá', 63),
(144, 'Caldas', 5),
(145, 'Caldas', 15),
(146, 'Caldono', 19),
(147, 'California', 68),
(148, 'Calima (Darién)', 76),
(149, 'Caloto', 19),
(150, 'Calí', 76),
(151, 'Campamento', 5),
(152, 'Campo de la Cruz', 8),
(153, 'Campoalegre', 41),
(154, 'Campohermoso', 15),
(155, 'Canalete', 23),
(156, 'Candelaria', 8),
(157, 'Candelaria', 76),
(158, 'Cantagallo', 13),
(159, 'Cantón de San Pablo', 27),
(160, 'Caparrapí', 25),
(161, 'Capitanejo', 68),
(162, 'Caracolí', 5),
(163, 'Caramanta', 5),
(164, 'Carcasí', 68),
(165, 'Carepa', 5),
(166, 'Carmen de Apicalá', 73),
(167, 'Carmen de Carupa', 25),
(168, 'Carmen de Viboral', 5),
(169, 'Carmen del Darién (CURBARADÓ)', 27),
(170, 'Carolina', 5),
(171, 'Cartagena', 13),
(172, 'Cartagena del Chairá', 18),
(173, 'Cartago', 76),
(174, 'Carurú', 97),
(175, 'Casabianca', 73),
(176, 'Castilla la Nueva', 50),
(177, 'Caucasia', 5),
(178, 'Cañasgordas', 5),
(179, 'Cepita', 68),
(180, 'Cereté', 23),
(181, 'Cerinza', 15),
(182, 'Cerrito', 68),
(183, 'Cerro San Antonio', 47),
(184, 'Chachaguí', 52),
(185, 'Chaguaní', 25),
(186, 'Chalán', 70),
(187, 'Chaparral', 73),
(188, 'Charalá', 68),
(189, 'Charta', 68),
(190, 'Chigorodó', 5),
(191, 'Chima', 68),
(192, 'Chimichagua', 20),
(193, 'Chimá', 23),
(194, 'Chinavita', 15),
(195, 'Chinchiná', 17),
(196, 'Chinácota', 54),
(197, 'Chinú', 23),
(198, 'Chipaque', 25),
(199, 'Chipatá', 68),
(200, 'Chiquinquirá', 15),
(201, 'Chiriguaná', 20),
(202, 'Chiscas', 15),
(203, 'Chita', 15),
(204, 'Chitagá', 54),
(205, 'Chitaraque', 15),
(206, 'Chivatá', 15),
(207, 'Chivolo', 47),
(208, 'Choachí', 25),
(209, 'Chocontá', 25),
(210, 'Chámeza', 85),
(211, 'Chía', 25),
(212, 'Chíquiza', 15),
(213, 'Chívor', 15),
(214, 'Cicuco', 13),
(215, 'Cimitarra', 68),
(216, 'Circasia', 63),
(217, 'Cisneros', 5),
(218, 'Ciénaga', 15),
(219, 'Ciénaga', 47),
(220, 'Ciénaga de Oro', 23),
(221, 'Clemencia', 13),
(222, 'Cocorná', 5),
(223, 'Coello', 73),
(224, 'Cogua', 25),
(225, 'Colombia', 41),
(226, 'Colosó (Ricaurte)', 70),
(227, 'Colón', 86),
(228, 'Colón (Génova)', 52),
(229, 'Concepción', 5),
(230, 'Concepción', 68),
(231, 'Concordia', 5),
(232, 'Concordia', 47),
(233, 'Condoto', 27),
(234, 'Confines', 68),
(235, 'Consaca', 52),
(236, 'Contadero', 52),
(237, 'Contratación', 68),
(238, 'Convención', 54),
(239, 'Copacabana', 5),
(240, 'Coper', 15),
(241, 'Cordobá', 63),
(242, 'Corinto', 19),
(243, 'Coromoro', 68),
(244, 'Corozal', 70),
(245, 'Corrales', 15),
(246, 'Cota', 25),
(247, 'Cotorra', 23),
(248, 'Covarachía', 15),
(249, 'Coveñas', 70),
(250, 'Coyaima', 73),
(251, 'Cravo Norte', 81),
(252, 'Cuaspud (Carlosama)', 52),
(253, 'Cubarral', 50),
(254, 'Cubará', 15),
(255, 'Cucaita', 15),
(256, 'Cucunubá', 25),
(257, 'Cucutilla', 54),
(258, 'Cuitiva', 15),
(259, 'Cumaral', 50),
(260, 'Cumaribo', 99),
(261, 'Cumbal', 52),
(262, 'Cumbitara', 52),
(263, 'Cunday', 73),
(264, 'Curillo', 18),
(265, 'Curití', 68),
(266, 'Curumaní', 20),
(267, 'Cáceres', 5),
(268, 'Cáchira', 54),
(269, 'Cácota', 54),
(270, 'Cáqueza', 25),
(271, 'Cértegui', 27),
(272, 'Cómbita', 15),
(273, 'Córdoba', 13),
(274, 'Córdoba', 52),
(275, 'Cúcuta', 54),
(276, 'Dabeiba', 5),
(277, 'Dagua', 76),
(278, 'Dibulla', 44),
(279, 'Distracción', 44),
(280, 'Dolores', 73),
(281, 'Don Matías', 5),
(282, 'Dos Quebradas', 66),
(283, 'Duitama', 15),
(284, 'Durania', 54),
(285, 'Ebéjico', 5),
(286, 'El Bagre', 5),
(287, 'El Banco', 47),
(288, 'El Cairo', 76),
(289, 'El Calvario', 50),
(290, 'El Carmen', 54),
(291, 'El Carmen', 68),
(292, 'El Carmen de Atrato', 27),
(293, 'El Carmen de Bolívar', 13),
(294, 'El Castillo', 50),
(295, 'El Cerrito', 76),
(296, 'El Charco', 52),
(297, 'El Cocuy', 15),
(298, 'El Colegio', 25),
(299, 'El Copey', 20),
(300, 'El Doncello', 18),
(301, 'El Dorado', 50),
(302, 'El Dovio', 76),
(303, 'El Espino', 15),
(304, 'El Guacamayo', 68),
(305, 'El Guamo', 13),
(306, 'El Molino', 44),
(307, 'El Paso', 20),
(308, 'El Paujil', 18),
(309, 'El Peñol', 52),
(310, 'El Peñon', 13),
(311, 'El Peñon', 68),
(312, 'El Peñón', 25),
(313, 'El Piñon', 47),
(314, 'El Playón', 68),
(315, 'El Retorno', 95),
(316, 'El Retén', 47),
(317, 'El Roble', 70),
(318, 'El Rosal', 25),
(319, 'El Rosario', 52),
(320, 'El Tablón de Gómez', 52),
(321, 'El Tambo', 19),
(322, 'El Tambo', 52),
(323, 'El Tarra', 54),
(324, 'El Zulia', 54),
(325, 'El Águila', 76),
(326, 'Elías', 41),
(327, 'Encino', 68),
(328, 'Enciso', 68),
(329, 'Entrerríos', 5),
(330, 'Envigado', 5),
(331, 'Espinal', 73),
(332, 'Facatativá', 25),
(333, 'Falan', 73),
(334, 'Filadelfia', 17),
(335, 'Filandia', 63),
(336, 'Firavitoba', 15),
(337, 'Flandes', 73),
(338, 'Florencia', 18),
(339, 'Florencia', 19),
(340, 'Floresta', 15),
(341, 'Florida', 76),
(342, 'Floridablanca', 68),
(343, 'Florián', 68),
(344, 'Fonseca', 44),
(345, 'Fortúl', 81),
(346, 'Fosca', 25),
(347, 'Francisco Pizarro', 52),
(348, 'Fredonia', 5),
(349, 'Fresno', 73),
(350, 'Frontino', 5),
(351, 'Fuente de Oro', 50),
(352, 'Fundación', 47),
(353, 'Funes', 52),
(354, 'Funza', 25),
(355, 'Fusagasugá', 25),
(356, 'Fómeque', 25),
(357, 'Fúquene', 25),
(358, 'Gachalá', 25),
(359, 'Gachancipá', 25),
(360, 'Gachantivá', 15),
(361, 'Gachetá', 25),
(362, 'Galapa', 8),
(363, 'Galeras (Nueva Granada)', 70),
(364, 'Galán', 68),
(365, 'Gama', 25),
(366, 'Gamarra', 20),
(367, 'Garagoa', 15),
(368, 'Garzón', 41),
(369, 'Gigante', 41),
(370, 'Ginebra', 76),
(371, 'Giraldo', 5),
(372, 'Girardot', 25),
(373, 'Girardota', 5),
(374, 'Girón', 68),
(375, 'Gonzalez', 20),
(376, 'Gramalote', 54),
(377, 'Granada', 5),
(378, 'Granada', 25),
(379, 'Granada', 50),
(380, 'Guaca', 68),
(381, 'Guacamayas', 15),
(382, 'Guacarí', 76),
(383, 'Guachavés', 52),
(384, 'Guachené', 19),
(385, 'Guachetá', 25),
(386, 'Guachucal', 52),
(387, 'Guadalupe', 5),
(388, 'Guadalupe', 41),
(389, 'Guadalupe', 68),
(390, 'Guaduas', 25),
(391, 'Guaitarilla', 52),
(392, 'Gualmatán', 52),
(393, 'Guamal', 47),
(394, 'Guamal', 50),
(395, 'Guamo', 73),
(396, 'Guapota', 68),
(397, 'Guapí', 19),
(398, 'Guaranda', 70),
(399, 'Guarne', 5),
(400, 'Guasca', 25),
(401, 'Guatapé', 5),
(402, 'Guataquí', 25),
(403, 'Guatavita', 25),
(404, 'Guateque', 15),
(405, 'Guavatá', 68),
(406, 'Guayabal de Siquima', 25),
(407, 'Guayabetal', 25),
(408, 'Guayatá', 15),
(409, 'Guepsa', 68),
(410, 'Guicán', 15),
(411, 'Gutiérrez', 25),
(412, 'Guática', 66),
(413, 'Gámbita', 68),
(414, 'Gámeza', 15),
(415, 'Génova', 63),
(416, 'Gómez Plata', 5),
(417, 'Hacarí', 54),
(418, 'Hatillo de Loba', 13),
(419, 'Hato', 68),
(420, 'Hato Corozal', 85),
(421, 'Hatonuevo', 44),
(422, 'Heliconia', 5),
(423, 'Herrán', 54),
(424, 'Herveo', 73),
(425, 'Hispania', 5),
(426, 'Hobo', 41),
(427, 'Honda', 73),
(428, 'Ibagué', 73),
(429, 'Icononzo', 73),
(430, 'Iles', 52),
(431, 'Imúes', 52),
(432, 'Inzá', 19),
(433, 'Inírida', 94),
(434, 'Ipiales', 52),
(435, 'Isnos', 41),
(436, 'Istmina', 27),
(437, 'Itagüí', 5),
(438, 'Ituango', 5),
(439, 'Izá', 15),
(440, 'Jambaló', 19),
(441, 'Jamundí', 76),
(442, 'Jardín', 5),
(443, 'Jenesano', 15),
(444, 'Jericó', 5),
(445, 'Jericó', 15),
(446, 'Jerusalén', 25),
(447, 'Jesús María', 68),
(448, 'Jordán', 68),
(449, 'Juan de Acosta', 8),
(450, 'Junín', 25),
(451, 'Juradó', 27),
(452, 'La Apartada y La Frontera', 23),
(453, 'La Argentina', 41),
(454, 'La Belleza', 68),
(455, 'La Calera', 25),
(456, 'La Capilla', 15),
(457, 'La Ceja', 5),
(458, 'La Celia', 66),
(459, 'La Cruz', 52),
(460, 'La Cumbre', 76),
(461, 'La Dorada', 17),
(462, 'La Esperanza', 54),
(463, 'La Estrella', 5),
(464, 'La Florida', 52),
(465, 'La Gloria', 20),
(466, 'La Jagua de Ibirico', 20),
(467, 'La Jagua del Pilar', 44),
(468, 'La Llanada', 52),
(469, 'La Macarena', 50),
(470, 'La Merced', 17),
(471, 'La Mesa', 25),
(472, 'La Montañita', 18),
(473, 'La Palma', 25),
(474, 'La Paz', 68),
(475, 'La Paz (Robles)', 20),
(476, 'La Peña', 25),
(477, 'La Pintada', 5),
(478, 'La Plata', 41),
(479, 'La Playa', 54),
(480, 'La Primavera', 99),
(481, 'La Salina', 85),
(482, 'La Sierra', 19),
(483, 'La Tebaida', 63),
(484, 'La Tola', 52),
(485, 'La Unión', 5),
(486, 'La Unión', 52),
(487, 'La Unión', 70),
(488, 'La Unión', 76),
(489, 'La Uvita', 15),
(490, 'La Vega', 19),
(491, 'La Vega', 25),
(492, 'La Victoria', 15),
(493, 'La Victoria', 17),
(494, 'La Victoria', 76),
(495, 'La Virginia', 66),
(496, 'Labateca', 54),
(497, 'Labranzagrande', 15),
(498, 'Landázuri', 68),
(499, 'Lebrija', 68),
(500, 'Leiva', 52),
(501, 'Lejanías', 50),
(502, 'Lenguazaque', 25),
(503, 'Leticia', 91),
(504, 'Liborina', 5),
(505, 'Linares', 52),
(506, 'Lloró', 27),
(507, 'Lorica', 23),
(508, 'Los Córdobas', 23),
(509, 'Los Palmitos', 70),
(510, 'Los Patios', 54),
(511, 'Los Santos', 68),
(512, 'Lourdes', 54),
(513, 'Luruaco', 8),
(514, 'Lérida', 73),
(515, 'Líbano', 73),
(516, 'López (Micay)', 19),
(517, 'Macanal', 15),
(518, 'Macaravita', 68),
(519, 'Maceo', 5),
(520, 'Machetá', 25),
(521, 'Madrid', 25),
(522, 'Magangué', 13),
(523, 'Magüi (Payán)', 52),
(524, 'Mahates', 13),
(525, 'Maicao', 44),
(526, 'Majagual', 70),
(527, 'Malambo', 8),
(528, 'Mallama (Piedrancha)', 52),
(529, 'Manatí', 8),
(530, 'Manaure', 44),
(531, 'Manaure Balcón del Cesar', 20),
(532, 'Manizales', 17),
(533, 'Manta', 25),
(534, 'Manzanares', 17),
(535, 'Maní', 85),
(536, 'Mapiripan', 50),
(537, 'Margarita', 13),
(538, 'Marinilla', 5),
(539, 'Maripí', 15),
(540, 'Mariquita', 73),
(541, 'Marmato', 17),
(542, 'Marquetalia', 17),
(543, 'Marsella', 66),
(544, 'Marulanda', 17),
(545, 'María la Baja', 13),
(546, 'Matanza', 68),
(547, 'Medellín', 5),
(548, 'Medina', 25),
(549, 'Medio Atrato', 27),
(550, 'Medio Baudó', 27),
(551, 'Medio San Juan (ANDAGOYA)', 27),
(552, 'Melgar', 73),
(553, 'Mercaderes', 19),
(554, 'Mesetas', 50),
(555, 'Milán', 18),
(556, 'Miraflores', 15),
(557, 'Miraflores', 95),
(558, 'Miranda', 19),
(559, 'Mistrató', 66),
(560, 'Mitú', 97),
(561, 'Mocoa', 86),
(562, 'Mogotes', 68),
(563, 'Molagavita', 68),
(564, 'Momil', 23),
(565, 'Mompós', 13),
(566, 'Mongua', 15),
(567, 'Monguí', 15),
(568, 'Moniquirá', 15),
(569, 'Montebello', 5),
(570, 'Montecristo', 13),
(571, 'Montelíbano', 23),
(572, 'Montenegro', 63),
(573, 'Monteria', 23),
(574, 'Monterrey', 85),
(575, 'Morales', 13),
(576, 'Morales', 19),
(577, 'Morelia', 18),
(578, 'Morroa', 70),
(579, 'Mosquera', 25),
(580, 'Mosquera', 52),
(581, 'Motavita', 15),
(582, 'Moñitos', 23),
(583, 'Murillo', 73),
(584, 'Murindó', 5),
(585, 'Mutatá', 5),
(586, 'Mutiscua', 54),
(587, 'Muzo', 15),
(588, 'Málaga', 68),
(589, 'Nariño', 5),
(590, 'Nariño', 25),
(591, 'Nariño', 52),
(592, 'Natagaima', 73),
(593, 'Nechí', 5),
(594, 'Necoclí', 5),
(595, 'Neira', 17),
(596, 'Neiva', 41),
(597, 'Nemocón', 25),
(598, 'Nilo', 25),
(599, 'Nimaima', 25),
(600, 'Nobsa', 15),
(601, 'Nocaima', 25),
(602, 'Norcasia', 17),
(603, 'Norosí', 13),
(604, 'Novita', 27),
(605, 'Nueva Granada', 47),
(606, 'Nuevo Colón', 15),
(607, 'Nunchía', 85),
(608, 'Nuquí', 27),
(609, 'Nátaga', 41),
(610, 'Obando', 76),
(611, 'Ocamonte', 68),
(612, 'Ocaña', 54),
(613, 'Oiba', 68),
(614, 'Oicatá', 15),
(615, 'Olaya', 5),
(616, 'Olaya Herrera', 52),
(617, 'Onzaga', 68),
(618, 'Oporapa', 41),
(619, 'Orito', 86),
(620, 'Orocué', 85),
(621, 'Ortega', 73),
(622, 'Ospina', 52),
(623, 'Otanche', 15),
(624, 'Ovejas', 70),
(625, 'Pachavita', 15),
(626, 'Pacho', 25),
(627, 'Padilla', 19),
(628, 'Paicol', 41),
(629, 'Pailitas', 20),
(630, 'Paime', 25),
(631, 'Paipa', 15),
(632, 'Pajarito', 15),
(633, 'Palermo', 41),
(634, 'Palestina', 17),
(635, 'Palestina', 41),
(636, 'Palmar', 68),
(637, 'Palmar de Varela', 8),
(638, 'Palmas del Socorro', 68),
(639, 'Palmira', 76),
(640, 'Palmito', 70),
(641, 'Palocabildo', 73),
(642, 'Pamplona', 54),
(643, 'Pamplonita', 54),
(644, 'Pandi', 25),
(645, 'Panqueba', 15),
(646, 'Paratebueno', 25),
(647, 'Pasca', 25),
(648, 'Patía (El Bordo)', 19),
(649, 'Pauna', 15),
(650, 'Paya', 15),
(651, 'Paz de Ariporo', 85),
(652, 'Paz de Río', 15),
(653, 'Pedraza', 47),
(654, 'Pelaya', 20),
(655, 'Pensilvania', 17),
(656, 'Peque', 5),
(657, 'Pereira', 66),
(658, 'Pesca', 15),
(659, 'Peñol', 5),
(660, 'Piamonte', 19),
(661, 'Pie de Cuesta', 68),
(662, 'Piedras', 73),
(663, 'Piendamó', 19),
(664, 'Pijao', 63),
(665, 'Pijiño', 47),
(666, 'Pinchote', 68),
(667, 'Pinillos', 13),
(668, 'Piojo', 8),
(669, 'Pisva', 15),
(670, 'Pital', 41),
(671, 'Pitalito', 41),
(672, 'Pivijay', 47),
(673, 'Planadas', 73),
(674, 'Planeta Rica', 23),
(675, 'Plato', 47),
(676, 'Policarpa', 52),
(677, 'Polonuevo', 8),
(678, 'Ponedera', 8),
(679, 'Popayán', 19),
(680, 'Pore', 85),
(681, 'Potosí', 52),
(682, 'Pradera', 76),
(683, 'Prado', 73),
(684, 'Providencia', 52),
(685, 'Providencia', 88),
(686, 'Pueblo Bello', 20),
(687, 'Pueblo Nuevo', 23),
(688, 'Pueblo Rico', 66),
(689, 'Pueblorrico', 5),
(690, 'Puebloviejo', 47),
(691, 'Puente Nacional', 68),
(692, 'Puerres', 52),
(693, 'Puerto Asís', 86),
(694, 'Puerto Berrío', 5),
(695, 'Puerto Boyacá', 15),
(696, 'Puerto Caicedo', 86),
(697, 'Puerto Carreño', 99),
(698, 'Puerto Colombia', 8),
(699, 'Puerto Concordia', 50),
(700, 'Puerto Escondido', 23),
(701, 'Puerto Gaitán', 50),
(702, 'Puerto Guzmán', 86),
(703, 'Puerto Leguízamo', 86),
(704, 'Puerto Libertador', 23),
(705, 'Puerto Lleras', 50),
(706, 'Puerto López', 50),
(707, 'Puerto Nare', 5),
(708, 'Puerto Nariño', 91),
(709, 'Puerto Parra', 68),
(710, 'Puerto Rico', 18),
(711, 'Puerto Rico', 50),
(712, 'Puerto Rondón', 81),
(713, 'Puerto Salgar', 25),
(714, 'Puerto Santander', 54),
(715, 'Puerto Tejada', 19),
(716, 'Puerto Triunfo', 5),
(717, 'Puerto Wilches', 68),
(718, 'Pulí', 25),
(719, 'Pupiales', 52),
(720, 'Puracé (Coconuco)', 19),
(721, 'Purificación', 73),
(722, 'Purísima', 23),
(723, 'Pácora', 17),
(724, 'Páez', 15),
(725, 'Páez (Belalcazar)', 19),
(726, 'Páramo', 68),
(727, 'Quebradanegra', 25),
(728, 'Quetame', 25),
(729, 'Quibdó', 27),
(730, 'Quimbaya', 63),
(731, 'Quinchía', 66),
(732, 'Quipama', 15),
(733, 'Quipile', 25),
(734, 'Ragonvalia', 54),
(735, 'Ramiriquí', 15),
(736, 'Recetor', 85),
(737, 'Regidor', 13),
(738, 'Remedios', 5),
(739, 'Remolino', 47),
(740, 'Repelón', 8),
(741, 'Restrepo', 50),
(742, 'Restrepo', 76),
(743, 'Retiro', 5),
(744, 'Ricaurte', 25),
(745, 'Ricaurte', 52),
(746, 'Rio Negro', 68),
(747, 'Rioblanco', 73),
(748, 'Riofrío', 76),
(749, 'Riohacha', 44),
(750, 'Risaralda', 17),
(751, 'Rivera', 41),
(752, 'Roberto Payán (San José)', 52),
(753, 'Roldanillo', 76),
(754, 'Roncesvalles', 73),
(755, 'Rondón', 15),
(756, 'Rosas', 19),
(757, 'Rovira', 73),
(758, 'Ráquira', 15),
(759, 'Río Iró', 27),
(760, 'Río Quito', 27),
(761, 'Río Sucio', 17),
(762, 'Río Viejo', 13),
(763, 'Río de oro', 20),
(764, 'Ríonegro', 5),
(765, 'Ríosucio', 27),
(766, 'Sabana de Torres', 68),
(767, 'Sabanagrande', 8),
(768, 'Sabanalarga', 5),
(769, 'Sabanalarga', 8),
(770, 'Sabanalarga', 85),
(771, 'Sabanas de San Angel (SAN ANGEL)', 47),
(772, 'Sabaneta', 5),
(773, 'Saboyá', 15),
(774, 'Sahagún', 23),
(775, 'Saladoblanco', 41),
(776, 'Salamina', 17),
(777, 'Salamina', 47),
(778, 'Salazar', 54),
(779, 'Saldaña', 73),
(780, 'Salento', 63),
(781, 'Salgar', 5),
(782, 'Samacá', 15),
(783, 'Samaniego', 52),
(784, 'Samaná', 17),
(785, 'Sampués', 70),
(786, 'San Agustín', 41),
(787, 'San Alberto', 20),
(788, 'San Andrés', 68),
(789, 'San Andrés Sotavento', 23),
(790, 'San Andrés de Cuerquía', 5),
(791, 'San Antero', 23),
(792, 'San Antonio', 73),
(793, 'San Antonio de Tequendama', 25),
(794, 'San Benito', 68),
(795, 'San Benito Abad', 70),
(796, 'San Bernardo', 25),
(797, 'San Bernardo', 52),
(798, 'San Bernardo del Viento', 23),
(799, 'San Calixto', 54),
(800, 'San Carlos', 5),
(801, 'San Carlos', 23),
(802, 'San Carlos de Guaroa', 50),
(803, 'San Cayetano', 25),
(804, 'San Cayetano', 54),
(805, 'San Cristobal', 13),
(806, 'San Diego', 20),
(807, 'San Eduardo', 15),
(808, 'San Estanislao', 13),
(809, 'San Fernando', 13),
(810, 'San Francisco', 5),
(811, 'San Francisco', 25),
(812, 'San Francisco', 86),
(813, 'San Gíl', 68),
(814, 'San Jacinto', 13),
(815, 'San Jacinto del Cauca', 13),
(816, 'San Jerónimo', 5),
(817, 'San Joaquín', 68),
(818, 'San José', 17),
(819, 'San José de Miranda', 68),
(820, 'San José de Montaña', 5),
(821, 'San José de Pare', 15),
(822, 'San José de Uré', 23),
(823, 'San José del Fragua', 18),
(824, 'San José del Guaviare', 95),
(825, 'San José del Palmar', 27),
(826, 'San Juan de Arama', 50),
(827, 'San Juan de Betulia', 70),
(828, 'San Juan de Nepomuceno', 13),
(829, 'San Juan de Pasto', 52),
(830, 'San Juan de Río Seco', 25),
(831, 'San Juan de Urabá', 5),
(832, 'San Juan del Cesar', 44),
(833, 'San Juanito', 50),
(834, 'San Lorenzo', 52),
(835, 'San Luis', 73),
(836, 'San Luís', 5),
(837, 'San Luís de Gaceno', 15),
(838, 'San Luís de Palenque', 85),
(839, 'San Marcos', 70),
(840, 'San Martín', 20),
(841, 'San Martín', 50),
(842, 'San Martín de Loba', 13),
(843, 'San Mateo', 15),
(844, 'San Miguel', 68),
(845, 'San Miguel', 86),
(846, 'San Miguel de Sema', 15),
(847, 'San Onofre', 70),
(848, 'San Pablo', 13),
(849, 'San Pablo', 52),
(850, 'San Pablo de Borbur', 15),
(851, 'San Pedro', 5),
(852, 'San Pedro', 70),
(853, 'San Pedro', 76),
(854, 'San Pedro de Cartago', 52),
(855, 'San Pedro de Urabá', 5),
(856, 'San Pelayo', 23),
(857, 'San Rafael', 5),
(858, 'San Roque', 5),
(859, 'San Sebastián', 19),
(860, 'San Sebastián de Buenavista', 47),
(861, 'San Vicente', 5),
(862, 'San Vicente del Caguán', 18),
(863, 'San Vicente del Chucurí', 68),
(864, 'San Zenón', 47),
(865, 'Sandoná', 52),
(866, 'Santa Ana', 47),
(867, 'Santa Bárbara', 5),
(868, 'Santa Bárbara', 68),
(869, 'Santa Bárbara (Iscuandé)', 52),
(870, 'Santa Bárbara de Pinto', 47),
(871, 'Santa Catalina', 13),
(872, 'Santa Fé de Antioquia', 5),
(873, 'Santa Genoveva de Docorodó', 27),
(874, 'Santa Helena del Opón', 68),
(875, 'Santa Isabel', 73),
(876, 'Santa Lucía', 8),
(877, 'Santa Marta', 47),
(878, 'Santa María', 15),
(879, 'Santa María', 41),
(880, 'Santa Rosa', 13),
(881, 'Santa Rosa', 19),
(882, 'Santa Rosa de Cabal', 66),
(883, 'Santa Rosa de Osos', 5),
(884, 'Santa Rosa de Viterbo', 15),
(885, 'Santa Rosa del Sur', 13),
(886, 'Santa Rosalía', 99),
(887, 'Santa Sofía', 15),
(888, 'Santana', 15),
(889, 'Santander de Quilichao', 19),
(890, 'Santiago', 54),
(891, 'Santiago', 86),
(892, 'Santo Domingo', 5),
(893, 'Santo Tomás', 8),
(894, 'Santuario', 5),
(895, 'Santuario', 66),
(896, 'Sapuyes', 52),
(897, 'Saravena', 81),
(898, 'Sardinata', 54),
(899, 'Sasaima', 25),
(900, 'Sativanorte', 15),
(901, 'Sativasur', 15),
(902, 'Segovia', 5),
(903, 'Sesquilé', 25),
(904, 'Sevilla', 76),
(905, 'Siachoque', 15),
(906, 'Sibaté', 25),
(907, 'Sibundoy', 86),
(908, 'Silos', 54),
(909, 'Silvania', 25),
(910, 'Silvia', 19),
(911, 'Simacota', 68),
(912, 'Simijaca', 25),
(913, 'Simití', 13),
(914, 'Sincelejo', 70),
(915, 'Sincé', 70),
(916, 'Sipí', 27),
(917, 'Sitionuevo', 47),
(918, 'Soacha', 25),
(919, 'Soatá', 15),
(920, 'Socha', 15),
(921, 'Socorro', 68),
(922, 'Socotá', 15),
(923, 'Sogamoso', 15),
(924, 'Solano', 18),
(925, 'Soledad', 8),
(926, 'Solita', 18),
(927, 'Somondoco', 15),
(928, 'Sonsón', 5),
(929, 'Sopetrán', 5),
(930, 'Soplaviento', 13),
(931, 'Sopó', 25),
(932, 'Sora', 15),
(933, 'Soracá', 15),
(934, 'Sotaquirá', 15),
(935, 'Sotara (Paispamba)', 19),
(936, 'Sotomayor (Los Andes)', 52),
(937, 'Suaita', 68),
(938, 'Suan', 8),
(939, 'Suaza', 41),
(940, 'Subachoque', 25),
(941, 'Sucre', 19),
(942, 'Sucre', 68),
(943, 'Sucre', 70),
(944, 'Suesca', 25),
(945, 'Supatá', 25),
(946, 'Supía', 17),
(947, 'Suratá', 68),
(948, 'Susa', 25),
(949, 'Susacón', 15),
(950, 'Sutamarchán', 15),
(951, 'Sutatausa', 25),
(952, 'Sutatenza', 15),
(953, 'Suárez', 19),
(954, 'Suárez', 73),
(955, 'Sácama', 85),
(956, 'Sáchica', 15),
(957, 'Tabio', 25),
(958, 'Tadó', 27),
(959, 'Talaigua Nuevo', 13),
(960, 'Tamalameque', 20),
(961, 'Tame', 81),
(962, 'Taminango', 52),
(963, 'Tangua', 52),
(964, 'Taraira', 97),
(965, 'Tarazá', 5),
(966, 'Tarqui', 41),
(967, 'Tarso', 5),
(968, 'Tasco', 15),
(969, 'Tauramena', 85),
(970, 'Tausa', 25),
(971, 'Tello', 41),
(972, 'Tena', 25),
(973, 'Tenerife', 47),
(974, 'Tenjo', 25),
(975, 'Tenza', 15),
(976, 'Teorama', 54),
(977, 'Teruel', 41),
(978, 'Tesalia', 41),
(979, 'Tibacuy', 25),
(980, 'Tibaná', 15),
(981, 'Tibasosa', 15),
(982, 'Tibirita', 25),
(983, 'Tibú', 54),
(984, 'Tierralta', 23),
(985, 'Timaná', 41),
(986, 'Timbiquí', 19),
(987, 'Timbío', 19),
(988, 'Tinjacá', 15),
(989, 'Tipacoque', 15),
(990, 'Tiquisio (Puerto Rico)', 13),
(991, 'Titiribí', 5),
(992, 'Toca', 15),
(993, 'Tocaima', 25),
(994, 'Tocancipá', 25),
(995, 'Toguí', 15),
(996, 'Toledo', 5),
(997, 'Toledo', 54),
(998, 'Tolú', 70),
(999, 'Tolú Viejo', 70),
(1000, 'Tona', 68),
(1001, 'Topagá', 15),
(1002, 'Topaipí', 25),
(1003, 'Toribío', 19),
(1004, 'Toro', 76),
(1005, 'Tota', 15),
(1006, 'Totoró', 19),
(1007, 'Trinidad', 85),
(1008, 'Trujillo', 76),
(1009, 'Tubará', 8),
(1010, 'Tuchín', 23),
(1011, 'Tulúa', 76),
(1012, 'Tumaco', 52),
(1013, 'Tunja', 15),
(1014, 'Tunungua', 15),
(1015, 'Turbaco', 13),
(1016, 'Turbaná', 13),
(1017, 'Turbo', 5),
(1018, 'Turmequé', 15),
(1019, 'Tuta', 15),
(1020, 'Tutasá', 15),
(1021, 'Támara', 85),
(1022, 'Támesis', 5),
(1023, 'Túquerres', 52),
(1024, 'Ubalá', 25),
(1025, 'Ubaque', 25),
(1026, 'Ubaté', 25),
(1027, 'Ulloa', 76),
(1028, 'Une', 25),
(1029, 'Unguía', 27),
(1030, 'Unión Panamericana (ÁNIMAS)', 27),
(1031, 'Uramita', 5),
(1032, 'Uribe', 50),
(1033, 'Uribia', 44),
(1034, 'Urrao', 5),
(1035, 'Urumita', 44),
(1036, 'Usiacuri', 8),
(1037, 'Valdivia', 5),
(1038, 'Valencia', 23),
(1039, 'Valle de San José', 68),
(1040, 'Valle de San Juan', 73),
(1041, 'Valle del Guamuez', 86),
(1042, 'Valledupar', 20),
(1043, 'Valparaiso', 5),
(1044, 'Valparaiso', 18),
(1045, 'Vegachí', 5),
(1046, 'Venadillo', 73),
(1047, 'Venecia', 5),
(1048, 'Venecia (Ospina Pérez)', 25),
(1049, 'Ventaquemada', 15),
(1050, 'Vergara', 25),
(1051, 'Versalles', 76),
(1052, 'Vetas', 68),
(1053, 'Viani', 25),
(1054, 'Vigía del Fuerte', 5),
(1055, 'Vijes', 76),
(1056, 'Villa Caro', 54),
(1057, 'Villa Rica', 19),
(1058, 'Villa de Leiva', 15),
(1059, 'Villa del Rosario', 54),
(1060, 'Villagarzón', 86),
(1061, 'Villagómez', 25),
(1062, 'Villahermosa', 73),
(1063, 'Villamaría', 17),
(1064, 'Villanueva', 13),
(1065, 'Villanueva', 44),
(1066, 'Villanueva', 68),
(1067, 'Villanueva', 85),
(1068, 'Villapinzón', 25),
(1069, 'Villarrica', 73),
(1070, 'Villavicencio', 50),
(1071, 'Villavieja', 41),
(1072, 'Villeta', 25),
(1073, 'Viotá', 25),
(1074, 'Viracachá', 15),
(1075, 'Vista Hermosa', 50),
(1076, 'Viterbo', 17),
(1077, 'Vélez', 68),
(1078, 'Yacopí', 25),
(1079, 'Yacuanquer', 52),
(1080, 'Yaguará', 41),
(1081, 'Yalí', 5),
(1082, 'Yarumal', 5),
(1083, 'Yolombó', 5),
(1084, 'Yondó (Casabe)', 5),
(1085, 'Yopal', 85),
(1086, 'Yotoco', 76),
(1087, 'Yumbo', 76),
(1088, 'Zambrano', 13),
(1089, 'Zapatoca', 68),
(1090, 'Zapayán (PUNTA DE PIEDRAS)', 47),
(1091, 'Zaragoza', 5),
(1092, 'Zarzal', 76),
(1093, 'Zetaquirá', 15),
(1094, 'Zipacón', 25),
(1095, 'Zipaquirá', 25),
(1096, 'Zona Bananera (PRADO - SEVILLA)', 47),
(1097, 'Ábrego', 54),
(1098, 'Íquira', 41),
(1099, 'Úmbita', 15),
(1100, 'Útica', 25);

-- --------------------------------------------------------

--
-- Table structure for table `odontogramas`
--

CREATE TABLE `odontogramas` (
  `codigo` bigint NOT NULL,
  `codigoConsultaFK` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `odontogramas`
--

INSERT INTO `odontogramas` (`codigo`, `codigoConsultaFK`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2),
(9, 2),
(5, 3),
(6, 4),
(7, 4),
(8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `o_integrado`
--

CREATE TABLE `o_integrado` (
  `codigo_odontogramas_FK` bigint NOT NULL,
  `codigo_dientes_FK` bigint NOT NULL,
  `codigo_convenciones_FK` bigint DEFAULT NULL,
  `codigo` bigint NOT NULL,
  `codigo_convencionseccionFK` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `o_integrado`
--

INSERT INTO `o_integrado` (`codigo_odontogramas_FK`, `codigo_dientes_FK`, `codigo_convenciones_FK`, `codigo`, `codigo_convencionseccionFK`) VALUES
(1, 1, NULL, 1, NULL),
(1, 2, NULL, 2, NULL),
(1, 3, NULL, 3, NULL),
(1, 4, NULL, 4, NULL),
(1, 5, NULL, 5, NULL),
(1, 6, NULL, 6, NULL),
(1, 7, NULL, 7, NULL),
(1, 8, NULL, 8, NULL),
(1, 9, NULL, 9, NULL),
(1, 10, NULL, 10, NULL),
(1, 11, NULL, 11, NULL),
(1, 12, NULL, 12, NULL),
(1, 13, NULL, 13, NULL),
(1, 14, 2, 14, NULL),
(1, 15, NULL, 15, NULL),
(1, 16, NULL, 16, NULL),
(1, 17, NULL, 17, NULL),
(1, 18, NULL, 18, NULL),
(1, 19, NULL, 19, NULL),
(1, 20, NULL, 20, NULL),
(1, 21, NULL, 21, NULL),
(1, 22, NULL, 22, NULL),
(1, 23, NULL, 23, NULL),
(1, 24, NULL, 24, NULL),
(1, 25, NULL, 25, NULL),
(1, 26, NULL, 26, NULL),
(1, 28, NULL, 27, NULL),
(1, 29, NULL, 28, NULL),
(1, 30, NULL, 29, NULL),
(1, 31, NULL, 30, NULL),
(1, 32, NULL, 31, NULL),
(1, 33, NULL, 32, NULL),
(1, 34, NULL, 33, NULL),
(1, 35, NULL, 34, NULL),
(1, 36, NULL, 35, NULL),
(1, 37, NULL, 36, NULL),
(1, 38, NULL, 37, NULL),
(1, 39, NULL, 38, NULL),
(1, 40, NULL, 39, NULL),
(1, 41, NULL, 40, NULL),
(1, 42, NULL, 41, NULL),
(1, 43, NULL, 42, NULL),
(1, 44, NULL, 43, NULL),
(1, 45, NULL, 44, NULL),
(1, 46, NULL, 45, NULL),
(1, 47, NULL, 46, NULL),
(1, 48, NULL, 47, NULL),
(1, 49, NULL, 48, NULL),
(1, 50, NULL, 49, NULL),
(1, 51, NULL, 50, NULL),
(1, 52, NULL, 51, NULL),
(1, 53, NULL, 52, NULL),
(2, 1, NULL, 53, NULL),
(2, 2, NULL, 54, NULL),
(2, 3, NULL, 55, NULL),
(2, 4, NULL, 56, NULL),
(2, 5, NULL, 57, NULL),
(2, 6, NULL, 58, NULL),
(2, 7, NULL, 59, NULL),
(2, 8, NULL, 60, NULL),
(2, 9, NULL, 61, NULL),
(2, 10, NULL, 62, NULL),
(2, 11, NULL, 63, NULL),
(2, 12, NULL, 64, NULL),
(2, 13, NULL, 65, NULL),
(2, 14, 1, 66, NULL),
(2, 15, NULL, 67, NULL),
(2, 16, NULL, 68, NULL),
(2, 17, NULL, 69, NULL),
(2, 18, NULL, 70, NULL),
(2, 19, NULL, 71, NULL),
(2, 20, NULL, 72, NULL),
(2, 21, NULL, 73, NULL),
(2, 22, NULL, 74, NULL),
(2, 23, NULL, 75, NULL),
(2, 24, NULL, 76, NULL),
(2, 25, NULL, 77, NULL),
(2, 26, NULL, 78, NULL),
(2, 28, NULL, 79, NULL),
(2, 29, NULL, 80, NULL),
(2, 30, NULL, 81, NULL),
(2, 31, NULL, 82, NULL),
(2, 32, NULL, 83, NULL),
(2, 33, NULL, 84, NULL),
(2, 34, NULL, 85, NULL),
(2, 35, NULL, 86, NULL),
(2, 36, NULL, 87, NULL),
(2, 37, NULL, 88, NULL),
(2, 38, NULL, 89, NULL),
(2, 39, NULL, 90, NULL),
(2, 40, NULL, 91, NULL),
(2, 41, NULL, 92, NULL),
(2, 42, NULL, 93, NULL),
(2, 43, NULL, 94, NULL),
(2, 44, NULL, 95, NULL),
(2, 45, NULL, 96, NULL),
(2, 46, NULL, 97, NULL),
(2, 47, NULL, 98, NULL),
(2, 48, NULL, 99, NULL),
(2, 49, NULL, 100, NULL),
(2, 50, NULL, 101, NULL),
(2, 51, NULL, 102, NULL),
(2, 52, NULL, 103, NULL),
(2, 53, NULL, 104, NULL),
(3, 1, NULL, 105, NULL),
(3, 2, NULL, 106, NULL),
(3, 3, NULL, 107, NULL),
(3, 4, NULL, 108, NULL),
(3, 5, NULL, 109, NULL),
(3, 6, NULL, 110, NULL),
(3, 7, NULL, 111, NULL),
(3, 8, NULL, 112, NULL),
(3, 9, NULL, 113, NULL),
(3, 10, NULL, 114, NULL),
(3, 11, NULL, 115, NULL),
(3, 12, NULL, 116, NULL),
(3, 13, NULL, 117, NULL),
(3, 14, 1, 118, NULL),
(3, 15, NULL, 119, NULL),
(3, 16, NULL, 120, NULL),
(3, 17, NULL, 121, NULL),
(3, 18, NULL, 122, NULL),
(3, 19, NULL, 123, NULL),
(3, 20, NULL, 124, NULL),
(3, 21, NULL, 125, NULL),
(3, 22, NULL, 126, NULL),
(3, 23, NULL, 127, NULL),
(3, 24, NULL, 128, NULL),
(3, 25, NULL, 129, NULL),
(3, 26, NULL, 130, NULL),
(3, 28, NULL, 131, NULL),
(3, 29, NULL, 132, NULL),
(3, 30, NULL, 133, NULL),
(3, 31, NULL, 134, NULL),
(3, 32, NULL, 135, NULL),
(3, 33, NULL, 136, NULL),
(3, 34, NULL, 137, NULL),
(3, 35, NULL, 138, NULL),
(3, 36, NULL, 139, NULL),
(3, 37, NULL, 140, NULL),
(3, 38, NULL, 141, NULL),
(3, 39, NULL, 142, NULL),
(3, 40, NULL, 143, NULL),
(3, 41, NULL, 144, NULL),
(3, 42, NULL, 145, NULL),
(3, 43, NULL, 146, NULL),
(3, 44, NULL, 147, NULL),
(3, 45, NULL, 148, NULL),
(3, 46, NULL, 149, NULL),
(3, 47, NULL, 150, NULL),
(3, 48, NULL, 151, NULL),
(3, 49, NULL, 152, NULL),
(3, 50, NULL, 153, NULL),
(3, 51, NULL, 154, NULL),
(3, 52, NULL, 155, NULL),
(3, 53, NULL, 156, NULL),
(4, 1, NULL, 157, NULL),
(4, 2, NULL, 158, NULL),
(4, 3, NULL, 159, NULL),
(4, 4, NULL, 160, NULL),
(4, 5, NULL, 161, NULL),
(4, 6, NULL, 162, NULL),
(4, 7, NULL, 163, NULL),
(4, 8, NULL, 164, NULL),
(4, 9, NULL, 165, NULL),
(4, 10, NULL, 166, NULL),
(4, 11, NULL, 167, NULL),
(4, 12, NULL, 168, NULL),
(4, 13, NULL, 169, NULL),
(4, 14, 1, 170, NULL),
(4, 15, NULL, 171, NULL),
(4, 16, NULL, 172, NULL),
(4, 17, NULL, 173, NULL),
(4, 18, NULL, 174, NULL),
(4, 19, NULL, 175, NULL),
(4, 20, NULL, 176, NULL),
(4, 21, NULL, 177, NULL),
(4, 22, NULL, 178, NULL),
(4, 23, NULL, 179, NULL),
(4, 24, NULL, 180, NULL),
(4, 25, NULL, 181, NULL),
(4, 26, NULL, 182, NULL),
(4, 28, NULL, 183, NULL),
(4, 29, NULL, 184, NULL),
(4, 30, NULL, 185, NULL),
(4, 31, NULL, 186, NULL),
(4, 32, NULL, 187, NULL),
(4, 33, NULL, 188, NULL),
(4, 34, NULL, 189, NULL),
(4, 35, NULL, 190, NULL),
(4, 36, NULL, 191, NULL),
(4, 37, NULL, 192, NULL),
(4, 38, NULL, 193, NULL),
(4, 39, NULL, 194, NULL),
(4, 40, NULL, 195, NULL),
(4, 41, NULL, 196, NULL),
(4, 42, NULL, 197, NULL),
(4, 43, NULL, 198, NULL),
(4, 44, NULL, 199, NULL),
(4, 45, NULL, 200, NULL),
(4, 46, NULL, 201, NULL),
(4, 47, NULL, 202, NULL),
(4, 48, NULL, 203, NULL),
(4, 49, NULL, 204, NULL),
(4, 50, NULL, 205, NULL),
(4, 51, NULL, 206, NULL),
(4, 52, NULL, 207, NULL),
(4, 53, NULL, 208, NULL),
(5, 1, NULL, 209, NULL),
(5, 2, NULL, 210, NULL),
(5, 3, NULL, 211, NULL),
(5, 4, NULL, 212, NULL),
(5, 5, NULL, 213, NULL),
(5, 6, NULL, 214, NULL),
(5, 7, NULL, 215, NULL),
(5, 8, NULL, 216, NULL),
(5, 9, NULL, 217, NULL),
(5, 10, NULL, 218, NULL),
(5, 11, NULL, 219, NULL),
(5, 12, NULL, 220, NULL),
(5, 13, NULL, 221, NULL),
(5, 14, NULL, 222, NULL),
(5, 15, NULL, 223, NULL),
(5, 16, NULL, 224, NULL),
(5, 17, NULL, 225, NULL),
(5, 18, NULL, 226, NULL),
(5, 19, NULL, 227, NULL),
(5, 20, NULL, 228, NULL),
(5, 21, 1, 229, NULL),
(5, 22, NULL, 230, NULL),
(5, 23, NULL, 231, NULL),
(5, 24, NULL, 232, NULL),
(5, 25, NULL, 233, NULL),
(5, 26, NULL, 234, NULL),
(5, 28, NULL, 235, NULL),
(5, 29, NULL, 236, NULL),
(5, 30, NULL, 237, NULL),
(5, 31, NULL, 238, NULL),
(5, 32, NULL, 239, NULL),
(5, 33, NULL, 240, NULL),
(5, 34, NULL, 241, NULL),
(5, 35, NULL, 242, NULL),
(5, 36, NULL, 243, NULL),
(5, 37, NULL, 244, NULL),
(5, 38, NULL, 245, NULL),
(5, 39, NULL, 246, NULL),
(5, 40, NULL, 247, NULL),
(5, 41, NULL, 248, NULL),
(5, 42, NULL, 249, NULL),
(5, 43, NULL, 250, NULL),
(5, 44, NULL, 251, NULL),
(5, 45, NULL, 252, NULL),
(5, 46, NULL, 253, NULL),
(5, 47, NULL, 254, NULL),
(5, 48, NULL, 255, NULL),
(5, 49, NULL, 256, NULL),
(5, 50, NULL, 257, NULL),
(5, 51, NULL, 258, NULL),
(5, 52, NULL, 259, NULL),
(5, 53, NULL, 260, NULL),
(6, 1, NULL, 261, NULL),
(6, 2, NULL, 262, NULL),
(6, 3, NULL, 263, NULL),
(6, 4, NULL, 264, NULL),
(6, 5, NULL, 265, NULL),
(6, 6, NULL, 266, NULL),
(6, 7, NULL, 267, NULL),
(6, 8, NULL, 268, NULL),
(6, 9, NULL, 269, NULL),
(6, 10, NULL, 270, NULL),
(6, 11, NULL, 271, NULL),
(6, 12, NULL, 272, NULL),
(6, 13, NULL, 273, NULL),
(6, 14, NULL, 274, NULL),
(6, 15, NULL, 275, NULL),
(6, 16, NULL, 276, NULL),
(6, 17, NULL, 277, NULL),
(6, 18, NULL, 278, NULL),
(6, 19, NULL, 279, NULL),
(6, 20, NULL, 280, NULL),
(6, 21, 1, 281, NULL),
(6, 22, NULL, 282, NULL),
(6, 23, NULL, 283, NULL),
(6, 24, NULL, 284, NULL),
(6, 25, NULL, 285, NULL),
(6, 26, NULL, 286, NULL),
(6, 28, NULL, 287, NULL),
(6, 29, NULL, 288, NULL),
(6, 30, NULL, 289, NULL),
(6, 31, NULL, 290, NULL),
(6, 32, NULL, 291, NULL),
(6, 33, NULL, 292, NULL),
(6, 34, NULL, 293, NULL),
(6, 35, NULL, 294, NULL),
(6, 36, NULL, 295, NULL),
(6, 37, NULL, 296, NULL),
(6, 38, NULL, 297, NULL),
(6, 39, NULL, 298, NULL),
(6, 40, NULL, 299, NULL),
(6, 41, NULL, 300, NULL),
(6, 42, NULL, 301, NULL),
(6, 43, NULL, 302, NULL),
(6, 44, NULL, 303, NULL),
(6, 45, NULL, 304, NULL),
(6, 46, NULL, 305, NULL),
(6, 47, NULL, 306, NULL),
(6, 48, NULL, 307, NULL),
(6, 49, NULL, 308, NULL),
(6, 50, NULL, 309, NULL),
(6, 51, NULL, 310, NULL),
(6, 52, NULL, 311, NULL),
(6, 53, NULL, 312, NULL),
(7, 1, NULL, 313, NULL),
(7, 2, NULL, 314, NULL),
(7, 3, NULL, 315, NULL),
(7, 4, NULL, 316, NULL),
(7, 5, NULL, 317, NULL),
(7, 6, NULL, 318, NULL),
(7, 7, NULL, 319, NULL),
(7, 8, NULL, 320, NULL),
(7, 9, NULL, 321, NULL),
(7, 10, NULL, 322, NULL),
(7, 11, NULL, 323, NULL),
(7, 12, NULL, 324, NULL),
(7, 13, NULL, 325, NULL),
(7, 14, NULL, 326, NULL),
(7, 15, NULL, 327, NULL),
(7, 16, NULL, 328, NULL),
(7, 17, NULL, 329, NULL),
(7, 18, NULL, 330, NULL),
(7, 19, NULL, 331, NULL),
(7, 20, NULL, 332, NULL),
(7, 21, 1, 333, NULL),
(7, 22, NULL, 334, NULL),
(7, 23, NULL, 335, NULL),
(7, 24, NULL, 336, NULL),
(7, 25, NULL, 337, NULL),
(7, 26, NULL, 338, NULL),
(7, 28, NULL, 339, NULL),
(7, 29, NULL, 340, NULL),
(7, 30, NULL, 341, NULL),
(7, 31, NULL, 342, NULL),
(7, 32, NULL, 343, NULL),
(7, 33, NULL, 344, NULL),
(7, 34, NULL, 345, NULL),
(7, 35, NULL, 346, NULL),
(7, 36, NULL, 347, NULL),
(7, 37, NULL, 348, NULL),
(7, 38, NULL, 349, NULL),
(7, 39, NULL, 350, NULL),
(7, 40, NULL, 351, NULL),
(7, 41, NULL, 352, NULL),
(7, 42, NULL, 353, NULL),
(7, 43, NULL, 354, NULL),
(7, 44, NULL, 355, NULL),
(7, 45, NULL, 356, NULL),
(7, 46, NULL, 357, NULL),
(7, 47, NULL, 358, NULL),
(7, 48, NULL, 359, NULL),
(7, 49, NULL, 360, NULL),
(7, 50, NULL, 361, NULL),
(7, 51, NULL, 362, NULL),
(7, 52, NULL, 363, NULL),
(7, 53, NULL, 364, NULL),
(8, 1, NULL, 365, NULL),
(8, 2, NULL, 366, NULL),
(8, 3, NULL, 367, NULL),
(8, 4, NULL, 368, NULL),
(8, 5, NULL, 369, NULL),
(8, 6, NULL, 370, NULL),
(8, 7, NULL, 371, NULL),
(8, 8, NULL, 372, NULL),
(8, 9, NULL, 373, NULL),
(8, 10, NULL, 374, NULL),
(8, 11, NULL, 375, NULL),
(8, 12, NULL, 376, NULL),
(8, 13, NULL, 377, NULL),
(8, 14, NULL, 378, NULL),
(8, 15, NULL, 379, NULL),
(8, 16, NULL, 380, NULL),
(8, 17, NULL, 381, NULL),
(8, 18, NULL, 382, NULL),
(8, 19, NULL, 383, NULL),
(8, 20, NULL, 384, NULL),
(8, 21, 1, 385, NULL),
(8, 22, NULL, 386, NULL),
(8, 23, NULL, 387, NULL),
(8, 24, NULL, 388, NULL),
(8, 25, NULL, 389, NULL),
(8, 26, NULL, 390, NULL),
(8, 28, NULL, 391, NULL),
(8, 29, NULL, 392, NULL),
(8, 30, NULL, 393, NULL),
(8, 31, NULL, 394, NULL),
(8, 32, NULL, 395, NULL),
(8, 33, NULL, 396, NULL),
(8, 34, NULL, 397, NULL),
(8, 35, NULL, 398, NULL),
(8, 36, NULL, 399, NULL),
(8, 37, NULL, 400, NULL),
(8, 38, NULL, 401, NULL),
(8, 39, NULL, 402, NULL),
(8, 40, NULL, 403, NULL),
(8, 41, NULL, 404, NULL),
(8, 42, NULL, 405, NULL),
(8, 43, NULL, 406, NULL),
(8, 44, NULL, 407, NULL),
(8, 45, NULL, 408, NULL),
(8, 46, NULL, 409, NULL),
(8, 47, NULL, 410, NULL),
(8, 48, NULL, 411, NULL),
(8, 49, NULL, 412, NULL),
(8, 50, NULL, 413, NULL),
(8, 51, NULL, 414, NULL),
(8, 52, NULL, 415, NULL),
(8, 53, NULL, 416, NULL),
(9, 1, NULL, 417, NULL),
(9, 2, NULL, 418, NULL),
(9, 3, NULL, 419, NULL),
(9, 4, NULL, 420, NULL),
(9, 5, NULL, 421, NULL),
(9, 6, NULL, 422, NULL),
(9, 7, NULL, 423, NULL),
(9, 8, NULL, 424, NULL),
(9, 9, NULL, 425, NULL),
(9, 10, NULL, 426, NULL),
(9, 11, NULL, 427, NULL),
(9, 12, NULL, 428, NULL),
(9, 13, NULL, 429, NULL),
(9, 14, 1, 430, NULL),
(9, 15, NULL, 431, NULL),
(9, 16, NULL, 432, NULL),
(9, 17, NULL, 433, NULL),
(9, 18, NULL, 434, NULL),
(9, 19, NULL, 435, NULL),
(9, 20, NULL, 436, NULL),
(9, 21, NULL, 437, NULL),
(9, 22, NULL, 438, NULL),
(9, 23, NULL, 439, NULL),
(9, 24, NULL, 440, NULL),
(9, 25, NULL, 441, NULL),
(9, 26, NULL, 442, NULL),
(9, 28, NULL, 443, NULL),
(9, 29, NULL, 444, NULL),
(9, 30, NULL, 445, NULL),
(9, 31, NULL, 446, NULL),
(9, 32, NULL, 447, NULL),
(9, 33, NULL, 448, NULL),
(9, 34, NULL, 449, NULL),
(9, 35, NULL, 450, NULL),
(9, 36, NULL, 451, NULL),
(9, 37, NULL, 452, NULL),
(9, 38, NULL, 453, NULL),
(9, 39, NULL, 454, NULL),
(9, 40, NULL, 455, NULL),
(9, 41, NULL, 456, NULL),
(9, 42, NULL, 457, NULL),
(9, 43, NULL, 458, NULL),
(9, 44, NULL, 459, NULL),
(9, 45, NULL, 460, NULL),
(9, 46, NULL, 461, NULL),
(9, 47, NULL, 462, NULL),
(9, 48, NULL, 463, NULL),
(9, 49, NULL, 464, NULL),
(9, 50, NULL, 465, NULL),
(9, 51, NULL, 466, NULL),
(9, 52, NULL, 467, NULL),
(9, 53, NULL, 468, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
--

CREATE TABLE `pacientes` (
  `numero_documento` varchar(20) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidoUno` varchar(60) NOT NULL,
  `apellidoDos` varchar(60) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_inicio_tratamiento` date NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `estado` varchar(10) DEFAULT 'activo',
  `otrosAntecedentesFamiliares` varchar(90) DEFAULT NULL,
  `operaciones` varchar(300) DEFAULT NULL,
  `enfermedades` varchar(300) DEFAULT NULL,
  `alerias` varchar(300) DEFAULT NULL,
  `medicamentos` varchar(300) DEFAULT NULL,
  `codigo_residencia_FK` bigint NOT NULL,
  `codigo_tipo_documento_FK` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`numero_documento`, `nombres`, `apellidoUno`, `apellidoDos`, `fecha_nacimiento`, `fecha_inicio_tratamiento`, `telefono`, `sexo`, `estado`, `otrosAntecedentesFamiliares`, `operaciones`, `enfermedades`, `alerias`, `medicamentos`, `codigo_residencia_FK`, `codigo_tipo_documento_FK`) VALUES
('1121838795', 'Cesar', 'Diez', 'Malagon', '1988-01-31', '2024-01-17', '3187066736', 'mujer', 'activo', '', NULL, NULL, NULL, NULL, 1, 7),
('1997597893', 'Manuel Santiago', 'Garcia', 'Julio', '1999-12-10', '2024-01-19', '3004604190', 'hombre', 'activo', 'Hipertención por parte del papá y diabetes por parte de la mamá', NULL, NULL, NULL, NULL, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `procedimientos_odontologicos`
--

CREATE TABLE `procedimientos_odontologicos` (
  `codigo` bigint NOT NULL,
  `codigo_cup` varchar(100) NOT NULL,
  `descripcion` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `procedimientos_odontologicos`
--

INSERT INTO `procedimientos_odontologicos` (`codigo`, `codigo_cup`, `descripcion`) VALUES
(1, '230101', 'EXODONCIA DE DIENTE PERMANENTE UNIRRADICULAR'),
(2, '230102', 'EXODONCIA DE DIENTE PERMANENTE MULTIRRADICULAR'),
(3, '230103', 'EXODONCIA DE DIENTES PERMANENTES'),
(4, '230201', 'EXODONCIA DE DIENTE TEMPORAL UNIRRADICULAR'),
(5, '230202', 'EXODONCIA DE DIENTE TEMPORAL MULTIRRADICULAR'),
(6, '230203', 'EXODONCIA DE DIENTES TEMPORALES'),
(7, '231100', 'EXODONCIA QUIRURGICA UNIRRADICULAR SOD'),
(8, '231200', 'EXODONCIA QUIRURGICA MULTIRRADICULAR SOD'),
(9, '231301', 'EXODONCIA DE INCLUIDO EN POSICION ECTOPICA CON ABORDAJE INTRAORAL'),
(10, '231302', 'EXODONCIA DE INCLUIDO EN POSICION ECTOPICA CON ABORDAJE EXTRAORAL'),
(11, '231303', 'EXODONCIA DE DIENTE INCLUIDO'),
(12, '231400', 'EXODONCIAS MULTIPLES CON ALVEOLOPLASTIA, POR CUADRANTE SOD'),
(13, '231500', 'COLGAJO DESPLAZADO PARA ABORDAJE DE DIENTE RETENIDO (VENTANA QUIRURGICA) SOD'),
(14, '232101', 'OBTURACION DENTAL CON AMALGAMA'),
(15, '232102', 'OBTURACION DENTAL CON RESINA DE FOTOCURADO'),
(16, '232103', 'OBTURACION DENTAL CON IONOMERO DE VIDRIO'),
(17, '232104', 'OBTURACION DENTAL'),
(18, '232200', 'OBTURACION TEMPORAL POR DIENTE SOD'),
(19, '232300', 'COLOCACION DE PIN MILIMETRICO SOD'),
(20, '232401', 'RECONSTRUCCION DE ANGULO INCISAL, CON RESINA DE FOTOCURADO'),
(21, '232402', 'RECONSTRUCCION TERCIO INCISAL, CON RESINA DE FOTOCURADO'),
(22, '232403', 'RECONSTRUCCION DENTAL'),
(23, '233100', 'RESTAURACION DE DIENTES MEDIANTE INCRUSTACION METALICA SOD'),
(24, '233200', 'RESTAURACION DE DIENTES MEDIANTE INCRUSTACION NO METALICA SOD'),
(25, '234101', 'COLOCACION O APLICACION DE CORONA EN ACERO INOXIDABLE (PARA DIENTES TEMPORALES)'),
(26, '234102', 'COLOCACION O APLICACION DE CORONA EN POLICARBOXILATO (PARA DIENTES TEMPORALES)'),
(27, '234103', 'COLOCACION O APLICACION DE CORONA EN FORMA PLASTICA'),
(28, '234104', 'COLOCACION O APLICACION DE CORONA ACRILICA TERMOCURADA'),
(29, '234105', 'INSERCION O APLICACION DE CORONA'),
(30, '234201', 'COLOCACION O INSERCION DE PROTESIS FIJA CADA UNIDAD (PILAR Y PONTICOS)'),
(31, '234202', 'RECONSTRUCCION DE MUÑONES'),
(32, '234203', 'PATRON DE NUCLEO'),
(33, '234204', 'REPARACION DE PROTESIS FIJA'),
(34, '234301', 'INSERCION, ADAPTACION Y CONTROL DE PROTESIS REMOVIBLE PARCIAL (SUPERIOR O INFERIOR) MUCOSOPORTADA'),
(35, '234302', 'INSERCION, ADAPTACION Y CONTROL DE PROTESIS REMOVIBLE PARCIAL (SUPERIOR O INFERIOR) DENTOMUCOSOPORTADA'),
(36, '234303', 'REPARACION DE PROTESIS REMOVIBLE PARCIAL'),
(37, '234401', 'INSERCION, ADAPTACION Y CONTROL DE PROTESIS MUCOSOPORTADA TOTAL MEDIO CASO SUPERIOR O INFERIOR'),
(38, '234402', 'INSERCION, ADAPTACION Y CONTROL DE PROTESIS MUCOSOPORTADA TOTAL SUPERIOR E INFERIOR'),
(39, '235100', 'REIMPLANTE DE DIENTE SOD'),
(40, '235200', 'TRASPLANTE DE DIENTE (INTENCIONAL) SOD'),
(41, '236100', 'IMPLANTE ALOPLASTICO CERAMICO SOD'),
(42, '236200', 'IMPLANTE ALOPLASTICO METALICO SOD'),
(43, '236300', 'IMPLANTE DENTAL ALOPLASTICO (OSEOINTEGRACION) SOD'),
(44, '237101', 'PULPOTOMIA CON PULPECTOMIA'),
(45, '237102', 'PULPOTOMIA'),
(46, '237200', 'APEXIFICACION (INDUCCION DE APEXOGENESIS) SOD'),
(47, '237301', 'TERAPIA DE CONDUCTO RADICULAR EN DIENTE UNIRRADICULAR'),
(48, '237302', 'TERAPIA DE CONDUCTO RADICULAR EN DIENTE BIRRADICULAR'),
(49, '237303', 'TERAPIA DE CONDUCTO RADICULAR EN DIENTE MULTIRRADICULAR'),
(50, '237304', 'TERAPIA DE CONDUCTO RADICULAR EN DIENTE TEMPORAL UNIRRADICULAR'),
(51, '237305', 'TERAPIA DE CONDUCTO RADICULAR EN DIENTE TEMPORAL MULTIRRADICULAR'),
(52, '237306', 'TERAPIA DE CONDUCTO RADICULAR'),
(53, '237401', 'CURETAJE APICAL CON APICECTOMIA Y OBTURACION RETROGADA (CIRUGIA PERIRRADICULAR)'),
(54, '237501', 'PROCEDIMIENTO CORRECTIVO EN RESORCION RADICULAR (INTERNA Y EXTERNA)'),
(55, '237502', 'PROCEDIMIENTOS CORRECTIVOS EN FRACTURAS RADICULARES'),
(56, '237601', 'FISTULIZACION ENDODONTICA POR TREPANACION Y DRENAJE'),
(57, '237602', 'FISTULIZACION ENDODONTICA POR INCISION'),
(58, '237603', 'FISTULIZACION ENDODONTICA'),
(59, '237701', 'RADECTOMIA (AMPUTACION RADICULAR) UNICA'),
(60, '237702', 'RADECTOMIA (AMPUTACION RADICULAR) MULTIPLE'),
(61, '237703', 'RADECTOMIA (AMPUTACION RADICULAR)'),
(62, '237800', 'HEMISECCION DEL DIENTE SOD'),
(63, '237901', 'BLANQUEAMIENTO DE DIENTE (INTRINSECO) POR CAUSAS ENDODONTICAS'),
(64, '237902', 'EXPLORACION Y MOVILIZACION DE NERVIO DENTARIO INFERIOR'),
(65, '240200', 'DETARTRAJE SUBGINGIVAL SOD'),
(66, '240300', 'ALISADO RADICULAR, CAMPO CERRADO SOD'),
(67, '240400', 'DRENAJE DE COLECCION PERIODONTAL (CERRADO CON ALISADO RADICULAR) SOD'),
(68, '241101', 'BIOPSIA INCISIONAL DE ENCIA'),
(69, '241102', 'BIOPSIA ESCISIONAL DE ENCIA CON CIERRE PRIMARIO'),
(70, '241103', 'BIOPSIA ESCISIONAL DE ENCIA Y RECUBRIMIENTO CON COLGAJO O INJERTO'),
(71, '241104', 'BIOPSIA DE ENCIA'),
(72, '241200', 'BIOPSIA DE PARED ALVEOLAR SOD'),
(73, '242101', 'PLASTIA MUCOGINGIVAL CON INJERTOS PEDICULADOS (COLGAJOS PEDICULADOS)'),
(74, '242102', 'PLASTIA MUCOGINGIVAL CON INJERTO GINGIVAL LIBRE'),
(75, '242103', 'PLASTIA MUCOGINGIVAL'),
(76, '242201', 'CURETAJE A CAMPO ABIERTO'),
(77, '242202', 'CIRUGIA A COLGAJO CON RESECCION RADICULAR (AMPUTACION, HEMISECCION)'),
(78, '242204', 'AUMENTO DE REBORDE PARCIALMENTE EDENTULO (SIN MATERIAL)'),
(79, '242205', 'AUMENTO DE REBORDE PARCIALMENTE EDENTULO (CON MATERIAL)'),
(80, '242300', 'PLASTIAS PREPROTESICAS (AUMENTO DE CORONA CLINICA) SOD'),
(81, '242400', 'REPARACION O PLASTIA PERIODONTAL REGENERATIVA (INJERTOS, MEMBRANAS) SOD'),
(82, '243101', 'ESCISION DE LESION BENIGNA ENCAPSULADA EN ENCIA HASTA DE TRES CENTIMETROS'),
(83, '243102', 'ESCISION DE LESION BENIGNA ENCAPSULADA EN ENCIA DE MAS DE TRES CENTIMETROS'),
(84, '243103', 'ESCISION DE LESION BENIGNA NO ENCAPSULADA EN ENCIA HASTA DE TRES CENTIMETROS'),
(85, '243104', 'ESCISION DE LESION BENIGNA NO ENCAPSULADA EN ENCIA DE MAS DE TRES CENTIMETROS'),
(86, '243105', 'ESCISION DE LESION MALIGNA DE ENCIA SIN VACIAMIENTO GANGLIONAR NI RESECCION DE ESTRUCTURAS VECINAS U OSEAS'),
(87, '243106', 'ESCISION DE LESION MALIGNA DE ENCIA CON VACIAMIENTO GANGLIONAR, PISO DE BOCA O LENGUA CON CIERRE PRIMARIO'),
(88, '243107', 'ESCISION DE LESION MALIGNA DE ENCIA CON VACIAMIENTO GANGLIONAR, PISO DE BOCA O LENGUA Y RECONSTRUCCION CON COLGAJO PEDICULADO'),
(89, '243108', 'ESCISION DE LESION MALIGNA DE ENCIA CON VACIAMIENTO GANGLIONAR, RESECCION OSEA Y RECONSTRUCCION CON PLACA Y COLGAJO PEDICULADO'),
(90, '243109', 'ESCISION DE LESION MALIGNA DE ENCIA CON VACIAMIENTO GANGLIONAR, RESECCION OSEA Y RECONSTRUCCION CON PLACA Y COLGAJO LIBRE'),
(91, '243110', 'RESECCION DE LESION DE ENCIA'),
(92, '243201', 'SUTURA DE LACERACION DE ENCIA, MENOR DE TRES CENTIMETROS'),
(93, '243202', 'SUTURA DE LACERACION DE ENCIA, MAYOR DE TRES CENTIMETROS'),
(94, '243203', 'SUTURA DE LACERACION DE ENCIA'),
(95, '243301', 'ENUCLEACION DE QUISTE EPIDERMOIDE, VIA INTRAORAL'),
(96, '243302', 'ENUCLEACION DE QUISTE EPIDERMOIDE, VIA EXTRAORAL'),
(97, '243303', 'ENUCLEACION DE QUISTE EPIDERMOIDE'),
(98, '243400', 'GINGIVECTOMIA SOD'),
(99, '243501', 'CUÑA DISTAL'),
(100, '243502', 'OPERCULECTOMIA'),
(101, '244101', 'ENUCLEACION DE QUISTE ODONTOGENICO HASTA DE TRES CENTIMETROS DE DIAMETRO'),
(102, '244102', 'ENUCLEACION DE QUISTE ODONTOGENICO DE MAS DE TRES CENTIMETROS DE DIAMETRO'),
(103, '244103', 'RESECCION DE TUMOR BENIGNO O MALIGNO ODONTOGENICO'),
(104, '244104', 'RESECCION DE TUMOR BENIGNO O MALIGNO ODONTOGENICO Y RECONSTRUCCION INMEDIATA CON INJERTO OSEO LIBRE'),
(105, '244105', 'RESECCION DE TUMOR BENIGNO O MALIGNO ODONTOGENICO Y RECONSTRUCCION CON COLGAJO OSEO PEDICULADO'),
(106, '244106', 'RESECCION DE TUMOR BENIGNO O MALIGNO ODONTOGENICO Y RECONSTRUCCION CON COLGAJO OSEO LIBRE'),
(107, '244107', 'RESECCION DE TUMOR BENIGNO O MALIGNO ODONTOGENICO Y RECONSTRUCCION CON PLACA'),
(108, '244108', 'MARSUPIALIZACION DE QUISTE ODONTOGENICO'),
(109, '244109', 'RESECCION DE LESION ODONTOGENICA SOD'),
(110, '245100', 'REGULARIZACION DE REBORDES SOD'),
(111, '245200', 'ALVEOLECTOMIA SOD'),
(112, '247100', 'COLOCACION DE APARATOLOGIA FIJA PARA ORTODONCIA (ARCADA) SOD'),
(113, '247201', 'COLOCACION DE APARATOLOGIA REMOVIBLE INTRAORAL PARA ORTODONCIA (ARCADA)'),
(114, '247202', 'COLOCACION DE APARATOLOGIA REMOVIBLE EXTRAORAL PARA ORTODONCIA (ARCADA)'),
(115, '247300', 'COLOCACION DE APARATOS DE RETENCION SOD'),
(116, '247401', 'FERULIZACION RIGIDA (SUPERIOR O INFERIOR)'),
(117, '247402', 'FERULIZACION SEMIRIGIDA (SUPERIOR O INFERIOR)'),
(118, '247403', 'FERULIZACION'),
(119, '248100', 'CIERRE DE DIASTEMA (ALVEOLAR, DENTAL) SOD'),
(120, '248200', 'AJUSTAMIENTO OCLUSAL SOD'),
(121, '248400', 'REPARACION DE APARATOLOGIA FIJA O REMOVIBLE SOD'),
(122, '248800', 'MASCARA FACIAL TERAPEUTICA SOD'),
(123, '249100', 'CONTROL DE HEMORRAGIA DENTAL POS QUIRURGICA SOD'),
(124, '250001', 'BIOPSIA CERRADA (PUNCION O ASPIRACION) DE LENGUA'),
(125, '250002', 'BIOPSIA INCISIONAL DE LENGUA (EN CUÑA)'),
(126, '252001', 'RESECCION DE LENGUA EN CUÑA'),
(127, '252002', 'RESECCION O ABLACION PARCIAL DE LENGUA '),
(128, '252501', 'HEMIGLOSECTOMIA CON CIERRE PRIMARIO'),
(129, '252506', 'HEMIGLOSECTOMIA CON COLGAJO LOCAL O A DISTANCIA VIA ABIERTA'),
(130, '252507', 'HEMIGLOSECTOMIA CON COLGAJO LOCAL O A DISTANCIA VIA ENDOSCOPICA'),
(131, '252508', 'HEMIGLOSECTOMIA CON RESECCION OSEA VIA ABIERTA'),
(132, '252509', 'HEMIGLOSECTOMIA CON RESECCION OSEA VIA ENDOSCOPICA'),
(133, '253401', 'GLOSECTOMIA TOTAL VIA ABIERTA'),
(134, '253402', 'GLOSECTOMIA TOTAL VIA ENDOSCOPICA'),
(135, '254001', 'GLOSECTOMIA RADICAL VIA ABIERTA'),
(136, '254002', 'GLOSECTOMIA RADICAL VIA ENDOSCOPICA'),
(137, '255001', 'GLOSOPLASTIA CON INJERTO CUTANEO O MUCOSO'),
(138, '255002', 'GLOSOPEXIA ANTERIOR'),
(139, '255003', 'GLOSOPEXIA POSTERIOR VIA ABIERTA'),
(140, '255004', 'GLOSOPEXIA POSTERIOR VIA ENDOSCOPICA'),
(141, '255006', 'PLASTIA DE FRENILLO LINGUAL'),
(142, '255007', 'DRENAJE DE COLECCION EN LENGUA'),
(143, '255101', 'SUTURA DE LACERACION DE LENGUA (GLOSORRAFIA) VIA ABIERTA'),
(144, '260101', 'SIALOLITOTOMIA VIA ABIERTA'),
(145, '260201', 'EXPLORACION DE GLANDULA SALIVAL VIA ABIERTA'),
(146, '260202', 'EXPLORACION DE GLANDULA SALIVAL VIA ENDOSCOPICA'),
(147, '260203', 'CATETERIZACION Y SIALOMETRIA'),
(148, '260301', 'DRENAJE DE GLANDULA SALIVAL VIA ABIERTA'),
(149, '260302', 'DRENAJE DE GLANDULA SALIVAL VIA ENDOSCOPICA'),
(150, '261001', 'BIOPSIA CERRADA DE GLANDULA O CONDUCTO SALIVAL (PUNCION O ASPIRACION CON AGUJA FINA O TRUCUT)'),
(151, '261002', 'BIOPSIA ABIERTA DE GLANDULA SALIVAL MENOR (CON CONDUCTO SALIVAL)'),
(152, '261003', 'BIOPSIA ABIERTA DE GLANDULA SALIVAL MAYOR (CON CONDUCTO SALIVAL)'),
(153, '262001', 'MARSUPIALIZACION DE LA RANULA'),
(154, '262002', 'RESECCION DE MUCOCELE DE GLANDULA SALIVAL'),
(155, '263101', 'PAROTIDECTOMIA DEL LOBULO SUPERFICIAL'),
(156, '263102', 'SIALOADENECTOMIA PARCIAL'),
(157, '263201', 'PAROTIDECTOMIA TOTAL'),
(158, '263203', 'SIALOADENECTOMIA DE GLANDULA SUBLINGUAL'),
(159, '263204', 'SIALOADENECTOMIA DE GLANDULA SUBMAXILAR (SUBMANDIBULAR)'),
(160, '263206', 'SIALOADENECTOMIA DE GLANDULAS SALIVALES MENORES'),
(161, '263208', 'REINTERVENCION DE GLANDULA SALIVAL MAYOR'),
(162, '264001', 'CIERRE O REPARACION DE FISTULA SALIVAL CON INJERTO VIA ABIERTA'),
(163, '264002', 'CIERRE O REPARACION DE FISTULA SALIVAL CON INJERTO VIA ENDOSCOPICA'),
(164, '264003', 'CIERRE O REPARACION DE FISTULA SALIVAL SIN INJERTO VIA ABIERTA'),
(165, '264004', 'CIERRE O REPARACION DE FISTULA SALIVAL SIN INJERTO VIA ENDOSCOPICA'),
(166, '264005', 'SIALOPLASTIA (REPARACION DEL CONDUCTO) CON INJERTO'),
(167, '264006', 'FISTULIZACION DE GLANDULA SALIVAL'),
(168, '264007', 'SIALOPLASTIA (REPARACION DEL CONDUCTO) VIA ABIERTA'),
(169, '264008', 'SIALOPLASTIA (REPARACION DEL CONDUCTO) VIA ENDOSCOPICA'),
(170, '270101', 'INCISION Y DRENAJE INTRAORAL EN CAVIDAD BUCAL'),
(171, '270102', 'INCISION Y DRENAJE EXTRAORAL EN CAVIDAD BUCAL'),
(172, '270103', 'INCISION Y DRENAJE EN CAVIDAD BUCAL'),
(173, '271101', 'DRENAJE DE COLECCION DE PALADAR VIA ABIERTA'),
(174, '272101', 'BIOPSIA DE UVULA'),
(175, '272102', 'BIOPSIA INCISIONAL DE PALADAR'),
(176, '272103', 'BIOPSIA ESCISIONAL DE PALADAR'),
(177, '272301', 'BIOPSIA INCISIONAL DE LABIO'),
(178, '272302', 'BIOPSIA ESCISIONAL DE LABIO'),
(179, '272401', 'BIOPSIA POR ASPIRACION CON AGUJA FINA EN CAVIDAD ORAL [BACAF]'),
(180, '272402', 'BIOPSIA DE PARED DE CAVIDAD BUCAL'),
(181, '273105', 'ESCISION O RESECCION O ABLACION DE LESION SUPERFICIAL DE PALADAR OSEO'),
(182, '273201', 'ESCISION O RESECCION O ABLACION DE LESION PROFUNDA DE PALADAR OSEO'),
(183, '273202', 'RESECCION EN BLOQUE DE APOFISIS ALVEOLAR Y PALADAR OSEO'),
(184, '273203', 'PALATECTOMIA DE PALADAR OSEO PARCIAL'),
(185, '273204', 'PALATECTOMIA DE PALADAR OSEO TOTAL'),
(186, '273301', 'ESCISION O RESECCION O ABLACION DE LESION SUPERFICIAL DE PALADAR BLANDO'),
(187, '273401', 'ESCISION O RESECCION O ABLACION DE LESION PROFUNDA DE PALADAR BLANDO'),
(188, '273402', 'PALATECTOMIA DE PALADAR BLANDO PARCIAL'),
(189, '273403', 'PALATECTOMIA DE PALADAR BLANDO TOTAL'),
(190, '274101', 'FRENILLECTOMIA LABIAL VIA ABIERTA'),
(191, '274201', 'RESECCION PARCIAL DE LABIO'),
(192, '274202', 'RESECCION PARCIAL DE LABIO CON ROTACION DE COLGAJO'),
(193, '274203', 'RESECCION TOTAL DE LABIO'),
(194, '274301', 'RESECCION DE LESION BENIGNA DE LA MUCOSA ORAL, HASTA DE DOS CENTIMETROS DE DIAMETRO'),
(195, '274302', 'RESECCION DE LESION BENIGNA DE LA MUCOSA ORAL, MAYOR DE DOS CENTIMETROS DE DIAMETRO'),
(196, '274303', 'RESECCION DE TUMOR MALIGNO DE MUCOSA ORAL'),
(197, '274304', 'RESECCION DE TUMOR MALIGNO DE MUCOSA ORAL, CON COLGAJO LOCAL O A DISTANCIA'),
(198, '274305', 'RESECCION DE LESION EN MUCOSA ORAL'),
(199, '274400', 'RESECCION DE FOSETAS LABIALES SOD'),
(200, '274901', 'REMOCION DE CUERPO EXTRAÑO EN TEJIDOS BLANDOS DE LA BOCA'),
(201, '274902', 'RESECCION DE BRIDAS INTRAORALES'),
(202, '275101', 'SUTURA O REPARACION DE LACERACION (HERIDA) EN LABIOS HASTA DE CINCO CENTIMETROS'),
(203, '275102', 'SUTURA O REPARACION DE LACERACION (HERIDA) EN LABIOS DE MAS DE CINCO CENTIMETROS'),
(204, '275103', 'SUTURA O PLASTIA EN AVULSION DE LABIOS'),
(205, '275104', 'SUTURA DE LACERACION EN LABIOS'),
(206, '275201', 'ESTOMATORRAFIA (SUTURA DE HERIDA EN MUCOSA ORAL) DE MENOS DE CINCO CENTIMETROS'),
(207, '275202', 'ESTOMATORRAFIA (SUTURA DE HERIDA EN MUCOSA ORAL) DE MAS DE CINCO CENTIMETROS'),
(208, '275203', 'SUTURA DE LACERACION DE OTRA PARTE DE LA BOCA '),
(209, '275301', 'RESECCION INTRAORAL DE FISTULA DE BOCA'),
(210, '275302', 'RESECCION EXTRAORAL DE FISTULA DE BOCA'),
(211, '275303', 'CIERRE DE FISTULA OROSINUSAL U ORONASAL, CON COLGAJO PALATINO, LINGUAL O BUCAL'),
(212, '275304', 'CIERRE DE FISTULA OROSINUSAL CON SINUSOTOMIA, CON O SIN REMOCION DE CUERPO EXTRAÑO O COLGAJO PALATINO, LINGUAL O BUCAL'),
(213, '275305', 'ALARGAMIENTO DE PALADAR CON COLGAJO EN ISLA'),
(214, '275401', 'CORRECCION PARCIAL DE LABIO FISURADO POR ADHESION'),
(215, '275402', 'CORRECCION PRIMARIA DE LABIO FISURADO UNILATERAL'),
(216, '275403', 'CORRECCION SECUNDARIA DE LABIO FISURADO UNILATERAL'),
(217, '275404', 'CORRECCION DE LABIO FISURADO BILATERAL'),
(218, '275405', 'REPARACION DE LABIO FISURADO (QUEILOPLASTIA)'),
(219, '275500', 'INJERTO DE PIEL DE GROSOR TOTAL APLICADO AL LABIO Y CAVIDAD BUCAL SOD'),
(220, '275601', 'LIPOINJERTO EN CARA'),
(221, '275701', 'INJERTO DE PIEL EN LABIOS CON ADHESION DE COLGAJO PEDICULADO'),
(222, '275801', 'PROFUNDIZACION O DESCENSO DE PISO DE BOCA CON DESINSERCION DE MILOHIODEO O GENIHIODEO'),
(223, '275802', 'PROFUNDIZACION DE PISO DE BOCA'),
(224, '275901', 'PROFUNDIZACION DE SURCO VESTIBULAR CON INJERTO MUCOSO'),
(225, '275902', 'PROFUNDIZACION DE SURCO VESTIBULAR CON INJERTO CUTANEO'),
(226, '275903', 'PROFUNDIZACION DE SURCO VESTIBULAR'),
(227, '276101', 'PALATORRAFIA EN Z'),
(228, '276102', 'SUTURA DE LACERACION DE PALADAR'),
(229, '276201', 'CORRECCION DE HENDIDURA ALVEOLOPALATINA'),
(230, '276202', 'CIERRE DE HENDIDURA ALVEOLAR CON INJERTO'),
(231, '276203', 'CIERRE DE HENDIDURA ALVEOLAR SIN INJERTO'),
(232, '276204', 'RECONSTRUCCION DE BOVEDA PALATINA MEDIANTE COLGAJOS PEDICULADOS'),
(233, '276205', 'CORRECCION DE FISURA PALATINA, CON COLGAJO VOMERIANO'),
(234, '276206', 'INJERTO OSEO DE PALADAR O ALVEOLAR'),
(235, '276207', 'UVULO-PALATO-FARINGOPLASTIA'),
(236, '276209', 'CORRECCION DE PALADAR FISURADO'),
(237, '276210', 'UVULO-PALATO-FARINGOPLASTIA POR ABLACION'),
(238, '276211', 'PALATOPLASTIA POR ABLACION'),
(239, '276212', 'PALATOPLASTIA CON COLGAJO UVULO-PALATAL'),
(240, '276301', 'REVISION DE REPARACION DEL PALADAR FISURADO'),
(241, '277101', 'INCISION DE LA UVULA'),
(242, '277201', 'RESECCION PARCIAL DE UVULA'),
(243, '277202', 'RESECCION TOTAL DE UVULA'),
(244, '277203', 'RESECCION DE UVULA POR ABLACION'),
(245, '277301', 'UVULORRAFIA'),
(246, '278200', 'INCISION DE CAVIDAD BUCAL, ESTRUCTURA NO ESPECIFICADA SOD'),
(247, '278401', 'CORRECCION DE MACROSTOMA'),
(248, '278402', 'CORRECCION DE MICROSTOMA'),
(249, '997101', 'APLICACION DE SELLANTES DE AUTOCURADO'),
(250, '997102', 'APLICACION DE SELLANTES DE FOTOCURADO'),
(251, '997103', 'TOPICACION DE FLUOR EN GEL'),
(252, '997104', 'TOPICACION DE FLUOR EN SOLUCION'),
(253, '997105', 'APLICACION DE RESINA PREVENTIVA'),
(254, '997106', 'TOPICACION DE FLUOR EN BARNIZ'),
(255, '997301', 'DETARTRAJE SUPRAGINGIVAL'),
(256, '997310', 'CONTROL DE PLACA DENTAL'),
(257, '870440', 'RADIOGRAFIAS INTRAORALES OCLUSALES'),
(258, '870450', 'RADIOGRAFIAS INTRAORALES PERIAPICALES MILIMETRADAS'),
(259, '870451', 'RADIOGRAFIAS INTRAORALES PERIAPICALES DIENTES ANTERIORES SUPERIORES'),
(260, '870452', 'RADIOGRAFIAS INTRAORALES PERIAPICALES DIENTES ANTERIORES INFERIORES'),
(261, '870453', 'RADIOGRAFIAS INTRAORALES PERIAPICALES ZONA DE CANINOS'),
(262, '870454', 'RADIOGRAFIAS INTRAORALES PERIAPICALES PREMOLARES'),
(263, '870455', 'RADIOGRAFIAS INTRAORALES PERIAPICALES MOLARES'),
(264, '870456', 'RADIOGRAFIAS INTRAORALES PERIAPICALES JUEGO COMPLETO'),
(265, '870460', 'RADIOGRAFIAS INTRAORALES CORONALES'),
(266, '893101', 'IMPRESION DE ARCO DENTARIO SUPERIOR O INFERIOR, CON MODELO DE ESTUDIO Y CONCEPTO'),
(267, '893102', 'FOTOGRAFIA CLINICA EXTRAORAL, INTRAORAL, FRONTAL O LATERAL'),
(268, '893103', 'EVALUACION Y MEDICION ORTODONTICA Y ORTOPEDICA ORAL'),
(269, '893104', 'ESTUDIO DE OCLUSION Y ARTICULACION TEMPOROMANDIBULAR'),
(270, '893105', 'MASCARA FACIAL DIAGNOSTICA'),
(271, '893106', 'CONTROL DE ORTODONCIA FIJA, REMOVIBLE O TRATAMIENTO ORTOPEDICO FUNCIONAL Y MECANICO'),
(272, '893107', 'ELABORACION Y ADAPTACION DE APARATO ORTOPEDICO'),
(273, '893108', 'CONTROL DE CRECIMIENTO Y DESARROLLO DENTO-MAXILOFACIAL'),
(274, '893109', 'EXAMEN O RECONOCIMIENTO DE MUCOSA ORAL Y PERIODONTAL'),
(275, '893110', 'ELABORACION Y ADAPTACION DE APARATO ORTESICO INTRAORAL'),
(276, '973400', 'EXTRACCION DE APARATOLOGIA ORTODONTICA FIJA SOD'),
(277, '973500', 'EXTRACCION DE PROTESIS DENTAL SOD'),
(278, '972200', 'SUSTITUCION DE TAPON DENTAL SOD'),
(279, '935500', 'APLICACION DE ALAMBRE DENTAL SOD'),
(280, '767801', 'REDUCCION CERRADA DE FRACTURA ORBITAL'),
(281, '767802', 'REDUCCION CERRADA DE FRACTURAS ALVEOLARES, CON REIMPLANTE DENTAL Y FIJACION'),
(282, '249100', 'CONTROL DE HEMORRAGIA DENTAL POS QUIRURGICA SOD'),
(283, '961200', 'INSERCION ADAPTACION DE APARATO ORTOPEDICO ORAL SOD'),
(284, '893101', 'IMPRESION DE ARCO DENTARIO SUPERIOR O INFERIOR, CON MODELO DE ESTUDIO Y CONCEPTO'),
(285, '893102', 'FOTOGRAFIA CLINICA EXTRAORAL, INTRAORAL, FRONTAL O LATERAL'),
(286, '893103', 'EVALUACION Y MEDICION ORTODONTICA Y ORTOPEDICA ORAL'),
(287, '893104', 'ESTUDIO DE OCLUSION Y ARTICULACION TEMPOROMANDIBULAR'),
(288, '893105', 'MASCARA FACIAL DIAGNOSTICA'),
(289, '893106', 'CONTROL DE ORTODONCIA FIJA, REMOVIBLE O TRATAMIENTO ORTOPEDICO FUNCIONAL Y MECANICO'),
(290, '893107', 'ELABORACION Y ADAPTACION DE APARATO ORTOPEDICO'),
(291, '893108', 'CONTROL DE CRECIMIENTO Y DESARROLLO DENTO-MAXILOFACIAL'),
(292, '893109', 'EXAMEN O RECONOCIMIENTO DE MUCOSA ORAL Y PERIODONTAL'),
(293, '893110', 'ELABORACION Y ADAPTACION DE APARATO ORTESICO INTRAORAL');

-- --------------------------------------------------------

--
-- Table structure for table `protesis`
--

CREATE TABLE `protesis` (
  `codigo` bigint NOT NULL,
  `presenciaProtesis` varchar(10) NOT NULL,
  `descripcion` text,
  `tipo` text,
  `id_historia_clinica_FK` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `regimen_usuarios`
--

CREATE TABLE `regimen_usuarios` (
  `codigo_tipousuario_FK` bigint NOT NULL,
  `codigoIps_FK` bigint NOT NULL,
  `numero_documento_paciente_FK` varchar(20) NOT NULL,
  `sucursal` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `residencias`
--

CREATE TABLE `residencias` (
  `codigo` bigint NOT NULL,
  `direccion_residencia` varchar(60) NOT NULL,
  `codigo_municipio_FK` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `residencias`
--

INSERT INTO `residencias` (`codigo`, `direccion_residencia`, `codigo_municipio_FK`) VALUES
(1, 'Calle 19 sur #37-70 nuevo horizonte', 1070),
(2, 'Arjona Bolivar Cr 43 #48-28 p2', 64);

-- --------------------------------------------------------

--
-- Table structure for table `responsables`
--

CREATE TABLE `responsables` (
  `codigo` bigint NOT NULL,
  `aplica` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `parentezco` varchar(30) NOT NULL,
  `numero_documento_paciente_FK` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `seccion`
--

CREATE TABLE `seccion` (
  `codigo` bigint NOT NULL,
  `nombreSeccion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `seccion`
--

INSERT INTO `seccion` (`codigo`, `nombreSeccion`) VALUES
(1, 'top'),
(2, 'bot'),
(3, 'left'),
(4, 'right'),
(5, 'center');

-- --------------------------------------------------------

--
-- Table structure for table `tipos_diagnosticos`
--

CREATE TABLE `tipos_diagnosticos` (
  `codigo` bigint NOT NULL,
  `diagnostico` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tipos_diagnosticos`
--

INSERT INTO `tipos_diagnosticos` (`codigo`, `diagnostico`) VALUES
(1, 'articular'),
(2, 'pulpar'),
(3, 'periodontal'),
(4, 'dental'),
(5, 'cd'),
(6, 'tejidosBlandos'),
(7, 'otros');

-- --------------------------------------------------------

--
-- Table structure for table `tipos_documentos`
--

CREATE TABLE `tipos_documentos` (
  `codigo` bigint NOT NULL,
  `clase_de_documento` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tipos_documentos`
--

INSERT INTO `tipos_documentos` (`codigo`, `clase_de_documento`) VALUES
(7, 'Cédula de Ciudadanía'),
(8, 'Cédula de Extranjería'),
(9, 'Tarjeta de Identidad'),
(10, 'Registro Civil'),
(11, 'Pasaporte'),
(12, 'Permiso Especial de Permanencia');

-- --------------------------------------------------------

--
-- Table structure for table `tipos_usuarios`
--

CREATE TABLE `tipos_usuarios` (
  `codigo` bigint NOT NULL,
  `clase_de_usuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tipos_usuarios`
--

INSERT INTO `tipos_usuarios` (`codigo`, `clase_de_usuario`) VALUES
(1, 'Particular'),
(2, 'Contributivo/Cotizante'),
(3, 'Contributivo/Beneficiario'),
(4, 'Subsidiado/Cotizante'),
(5, 'Subsidiado/Beneficiario');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `antecedentes_familiares`
--
ALTER TABLE `antecedentes_familiares`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `antecedentes_familiares_pacientes`
--
ALTER TABLE `antecedentes_familiares_pacientes`
  ADD KEY `numero_documento_paciente_FK_4` (`numero_documento_paciente_FK`),
  ADD KEY `codigo_antecedentes_familiares_FK` (`codigo_antecedentes_familiares_FK`);

--
-- Indexes for table `articulaciones_temporo_mandibulares`
--
ALTER TABLE `articulaciones_temporo_mandibulares`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_consultas_FK_4` (`codigo_historia_clinica_FK`);

--
-- Indexes for table `codigos_cies`
--
ALTER TABLE `codigos_cies`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `codigos_diagnosticos`
--
ALTER TABLE `codigos_diagnosticos`
  ADD KEY `codigo_cies_FK` (`codigo_cies_FK`),
  ADD KEY `codigo_tipo_diagnosticos_FK` (`codigo_tipo_diagnosticos_FK`),
  ADD KEY `codigo_diagnosticos_FK` (`codigo_diagnosticos_FK`);

--
-- Indexes for table `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `numero_documento_paciente_FK_1` (`numero_documento_paciente_FK`);

--
-- Indexes for table `convenciones`
--
ALTER TABLE `convenciones`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `convenciones_oc`
--
ALTER TABLE `convenciones_oc`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `convencion_seccion`
--
ALTER TABLE `convencion_seccion`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_convenciones_oc_FK_1` (`codigo_convenciones_oc_FK`),
  ADD KEY `codigo_seccion_FK_1` (`codigo_seccion_FK`),
  ADD KEY `codigoOI_FK` (`codigo_OI_FK`);

--
-- Indexes for table `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `diagnosticos`
--
ALTER TABLE `diagnosticos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_consultas_FK_1` (`codigo_historia_clinica_FK`);

--
-- Indexes for table `dientes`
--
ALTER TABLE `dientes`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `evoluciones_h_c`
--
ALTER TABLE `evoluciones_h_c`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_consultas_FK` (`codigo_consultas_FK`),
  ADD KEY `codigo_odontograma_FK_2` (`codigo_odontograma_FK`);

--
-- Indexes for table `higienes`
--
ALTER TABLE `higienes`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_consulta_FK_3` (`codigo_historia_clinica_FK`);

--
-- Indexes for table `historias_clinicas`
--
ALTER TABLE `historias_clinicas`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_paciente_hc` (`id_paciente_FK`);

--
-- Indexes for table `ips`
--
ALTER TABLE `ips`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_departamento_FK` (`codigo_departamento_FK`);

--
-- Indexes for table `odontogramas`
--
ALTER TABLE `odontogramas`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_consulta_FK3` (`codigoConsultaFK`);

--
-- Indexes for table `o_integrado`
--
ALTER TABLE `o_integrado`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_odontogramas_FK_1` (`codigo_odontogramas_FK`),
  ADD KEY `codigo_dientes_FK` (`codigo_dientes_FK`),
  ADD KEY `codigo_convenciones_FK` (`codigo_convenciones_FK`),
  ADD KEY `Codigo_convencionseccionFK` (`codigo_convencionseccionFK`);

--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`numero_documento`),
  ADD KEY `codigo_residencia_FK` (`codigo_residencia_FK`),
  ADD KEY `codigo_tipo_documento_FK` (`codigo_tipo_documento_FK`);

--
-- Indexes for table `procedimientos_odontologicos`
--
ALTER TABLE `procedimientos_odontologicos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `protesis`
--
ALTER TABLE `protesis`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_consulta_FK_4` (`id_historia_clinica_FK`);

--
-- Indexes for table `regimen_usuarios`
--
ALTER TABLE `regimen_usuarios`
  ADD KEY `codigo_tipousuario_FK` (`codigo_tipousuario_FK`),
  ADD KEY `codigoIps_FK` (`codigoIps_FK`),
  ADD KEY `numero_documento_paciente_FK_3` (`numero_documento_paciente_FK`);

--
-- Indexes for table `residencias`
--
ALTER TABLE `residencias`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_municipio_FK` (`codigo_municipio_FK`);

--
-- Indexes for table `responsables`
--
ALTER TABLE `responsables`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `numero_documento_paciente_FK` (`numero_documento_paciente_FK`);

--
-- Indexes for table `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `tipos_diagnosticos`
--
ALTER TABLE `tipos_diagnosticos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administradores`
--
ALTER TABLE `administradores`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `antecedentes_familiares`
--
ALTER TABLE `antecedentes_familiares`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `articulaciones_temporo_mandibulares`
--
ALTER TABLE `articulaciones_temporo_mandibulares`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `codigos_cies`
--
ALTER TABLE `codigos_cies`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- AUTO_INCREMENT for table `consultas`
--
ALTER TABLE `consultas`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `convenciones`
--
ALTER TABLE `convenciones`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `convenciones_oc`
--
ALTER TABLE `convenciones_oc`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `convencion_seccion`
--
ALTER TABLE `convencion_seccion`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `diagnosticos`
--
ALTER TABLE `diagnosticos`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dientes`
--
ALTER TABLE `dientes`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `evoluciones_h_c`
--
ALTER TABLE `evoluciones_h_c`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `higienes`
--
ALTER TABLE `higienes`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `historias_clinicas`
--
ALTER TABLE `historias_clinicas`
  MODIFY `Codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ips`
--
ALTER TABLE `ips`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `municipios`
--
ALTER TABLE `municipios`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1101;

--
-- AUTO_INCREMENT for table `odontogramas`
--
ALTER TABLE `odontogramas`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `o_integrado`
--
ALTER TABLE `o_integrado`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;

--
-- AUTO_INCREMENT for table `procedimientos_odontologicos`
--
ALTER TABLE `procedimientos_odontologicos`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- AUTO_INCREMENT for table `protesis`
--
ALTER TABLE `protesis`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residencias`
--
ALTER TABLE `residencias`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `responsables`
--
ALTER TABLE `responsables`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seccion`
--
ALTER TABLE `seccion`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tipos_diagnosticos`
--
ALTER TABLE `tipos_diagnosticos`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
  MODIFY `codigo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antecedentes_familiares_pacientes`
--
ALTER TABLE `antecedentes_familiares_pacientes`
  ADD CONSTRAINT `codigo_antecedentes_familiares_FK` FOREIGN KEY (`codigo_antecedentes_familiares_FK`) REFERENCES `antecedentes_familiares` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `numero_documento_paciente_FK_4` FOREIGN KEY (`numero_documento_paciente_FK`) REFERENCES `pacientes` (`numero_documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articulaciones_temporo_mandibulares`
--
ALTER TABLE `articulaciones_temporo_mandibulares`
  ADD CONSTRAINT `articulacion_historia_clinica` FOREIGN KEY (`codigo_historia_clinica_FK`) REFERENCES `historias_clinicas` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `codigos_diagnosticos`
--
ALTER TABLE `codigos_diagnosticos`
  ADD CONSTRAINT `codigo_cies_FK` FOREIGN KEY (`codigo_cies_FK`) REFERENCES `codigos_cies` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codigo_diagnosticos_FK` FOREIGN KEY (`codigo_diagnosticos_FK`) REFERENCES `diagnosticos` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codigo_tipo_diagnosticos_FK` FOREIGN KEY (`codigo_tipo_diagnosticos_FK`) REFERENCES `tipos_diagnosticos` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `numero_documento_paciente_FK_1` FOREIGN KEY (`numero_documento_paciente_FK`) REFERENCES `pacientes` (`numero_documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `convencion_seccion`
--
ALTER TABLE `convencion_seccion`
  ADD CONSTRAINT `codigo_convenciones_oc_FK_1` FOREIGN KEY (`codigo_convenciones_oc_FK`) REFERENCES `convenciones_oc` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codigo_seccion_FK_1` FOREIGN KEY (`codigo_seccion_FK`) REFERENCES `seccion` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codigoOI_FK` FOREIGN KEY (`codigo_OI_FK`) REFERENCES `o_integrado` (`codigo`);

--
-- Constraints for table `diagnosticos`
--
ALTER TABLE `diagnosticos`
  ADD CONSTRAINT `diagnosticos` FOREIGN KEY (`codigo_historia_clinica_FK`) REFERENCES `historias_clinicas` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evoluciones_h_c`
--
ALTER TABLE `evoluciones_h_c`
  ADD CONSTRAINT `codigo_consultas_FK` FOREIGN KEY (`codigo_consultas_FK`) REFERENCES `consultas` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codigo_odontograma_FK_2` FOREIGN KEY (`codigo_odontograma_FK`) REFERENCES `odontogramas` (`codigo`);

--
-- Constraints for table `higienes`
--
ALTER TABLE `higienes`
  ADD CONSTRAINT `higienes_historia_clinica` FOREIGN KEY (`codigo_historia_clinica_FK`) REFERENCES `historias_clinicas` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `historias_clinicas`
--
ALTER TABLE `historias_clinicas`
  ADD CONSTRAINT `fk_paciente_hc` FOREIGN KEY (`id_paciente_FK`) REFERENCES `pacientes` (`numero_documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `codigo_departamento_FK` FOREIGN KEY (`codigo_departamento_FK`) REFERENCES `departamentos` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `odontogramas`
--
ALTER TABLE `odontogramas`
  ADD CONSTRAINT `codigo_consulta_FK3` FOREIGN KEY (`codigoConsultaFK`) REFERENCES `consultas` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `o_integrado`
--
ALTER TABLE `o_integrado`
  ADD CONSTRAINT `codigo_convenciones_FK` FOREIGN KEY (`codigo_convenciones_FK`) REFERENCES `convenciones` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Codigo_convencionseccionFK` FOREIGN KEY (`codigo_convencionseccionFK`) REFERENCES `convencion_seccion` (`codigo`),
  ADD CONSTRAINT `codigo_dientes_FK` FOREIGN KEY (`codigo_dientes_FK`) REFERENCES `dientes` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codigo_odontogramas_FK_1` FOREIGN KEY (`codigo_odontogramas_FK`) REFERENCES `odontogramas` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `codigo_residencia_FK` FOREIGN KEY (`codigo_residencia_FK`) REFERENCES `residencias` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codigo_tipo_documento_FK` FOREIGN KEY (`codigo_tipo_documento_FK`) REFERENCES `tipos_documentos` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `protesis`
--
ALTER TABLE `protesis`
  ADD CONSTRAINT `protesis_historia_clinica` FOREIGN KEY (`id_historia_clinica_FK`) REFERENCES `historias_clinicas` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regimen_usuarios`
--
ALTER TABLE `regimen_usuarios`
  ADD CONSTRAINT `codigo_tipousuario_FK` FOREIGN KEY (`codigo_tipousuario_FK`) REFERENCES `tipos_usuarios` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codigoIps_FK` FOREIGN KEY (`codigoIps_FK`) REFERENCES `ips` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `numero_documento_paciente_FK_3` FOREIGN KEY (`numero_documento_paciente_FK`) REFERENCES `pacientes` (`numero_documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `residencias`
--
ALTER TABLE `residencias`
  ADD CONSTRAINT `codigo_municipio_FK` FOREIGN KEY (`codigo_municipio_FK`) REFERENCES `municipios` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `responsables`
--
ALTER TABLE `responsables`
  ADD CONSTRAINT `numero_documento_paciente_FK` FOREIGN KEY (`numero_documento_paciente_FK`) REFERENCES `pacientes` (`numero_documento`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
