-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jul 03, 2023 at 04:39 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `codigo` int(11) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `cargo` varchar(60) NOT NULL,
  `clave` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administradores`
--

INSERT INTO `administradores` (`codigo`, `nombres`, `apellidos`, `email`, `cargo`, `clave`) VALUES
(6, 'Gea', 'Coge Garcia', 'vgarciaj10@curnvirtual.edu.co', 'Dueña', '$2y$10$PsAlVCcP0zpy//m0Ag0Hx.rYgVRv9wIrkJoudo7SH6cVtsq.jay.q'),
(7, 'Inelda', 'Julio', 'ijuheherrera@gmail.com', 'hola', '$2y$10$R4fLauAN7zEL/wa1Qy1KDu8nWlFINHxNSZUEYpYNJOIY3GsJ65aLe'),
(10, 'Raymundo', 'García Puerta', 'raimyndo@gmail.com', 'admin', '$2y$10$0x1iAbYwJunn8OplK7I4UOh8mtsTmR0j.n85mUUFpIQjWDfDbF4gS'),
(11, 'Manuel Santiago', 'García', 'manegarju15@gmail.com', 'Admin', '$2y$10$cNZoQC2cUJhP7Fo8d3/V/u6cHQSvOZ3UgKg/1ZBbNospdrpHf3C9S'),
(12, 'Vanessa', 'Garcia Julio', 'vanegaju15@gmail.com', 'lo que sea', '$2y$10$soPDIrHO1ZS45sFy46C0d.T9OrtyvWSFwolEJweIfGSAfWxOASDUi');

-- --------------------------------------------------------

--
-- Table structure for table `antecedentes_familiares`
--

CREATE TABLE `antecedentes_familiares` (
  `codigo` int(11) NOT NULL,
  `lista_antecedentes_familiares` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `codigo_antecedentes_familiares_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `articulaciones_temporo_mandibulares`
--

CREATE TABLE `articulaciones_temporo_mandibulares` (
  `codigo` int(11) NOT NULL,
  `hallazgos_clinicos` varchar(90) NOT NULL,
  `sano` varchar(10) NOT NULL,
  `codigo_consultas_FK` int(200) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articulaciones_temporo_mandibulares`
--

INSERT INTO `articulaciones_temporo_mandibulares` (`codigo`, `hallazgos_clinicos`, `sano`, `codigo_consultas_FK`) VALUES
(1, 'ruidos', 'SI', 2),
(2, 'desviacion', 'NO', 2),
(3, 'cambioVolumen', 'SI', 2),
(4, 'bloqueoMandibular', 'NO', 2),
(5, 'limitacionApertura', 'NO', 2),
(6, 'dolorArticular', 'SI', 2),
(7, 'dolorMuscular', 'SI', 2);

-- --------------------------------------------------------

--
-- Table structure for table `codigos_cies`
--

CREATE TABLE `codigos_cies` (
  `codigo` int(11) NOT NULL,
  `codigo_alfa_numerico` varchar(10) NOT NULL,
  `descripcion_codigo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(358, 'Z965', 'PRESENCIA DE IMPLANTES DE RAIZ DE DIENTE Y DE MANDIBULA');

-- --------------------------------------------------------

--
-- Table structure for table `codigos_diagnosticos`
--

CREATE TABLE `codigos_diagnosticos` (
  `codigo_cies_FK` int(11) NOT NULL,
  `codigo_tipo_diagnosticos_FK` int(11) NOT NULL,
  `codigo_diagnosticos_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `consultas`
--

CREATE TABLE `consultas` (
  `codigo` int(11) NOT NULL,
  `fecha_consulta` date NOT NULL,
  `motivo_consulta` varchar(200) NOT NULL,
  `antecedentes_odontologicos_medicos_generales` varchar(200) NOT NULL,
  `evolucion_estadoA` varchar(200) NOT NULL,
  `examen_estomatologico` varchar(200) NOT NULL,
  `numero_documento_paciente_FK` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consultas`
--

INSERT INTO `consultas` (`codigo`, `fecha_consulta`, `motivo_consulta`, `antecedentes_odontologicos_medicos_generales`, `evolucion_estadoA`, `examen_estomatologico`, `numero_documento_paciente_FK`) VALUES
(1, '2023-06-07', 'zzz', 'zzz', 'zzz', 'zzz', '30761898'),
(2, '2023-06-01', 'zzzz', 'zzzz', 'ssss', 'ssss', '30761898');

-- --------------------------------------------------------

--
-- Table structure for table `convenciones`
--

CREATE TABLE `convenciones` (
  `codigo` int(11) NOT NULL,
  `convencion` varchar(30) NOT NULL,
  `figura` varchar(30) NOT NULL,
  `color` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `convenciones`
--

INSERT INTO `convenciones` (`codigo`, `convencion`, `figura`, `color`) VALUES
(1, 'Exodoncia Realizada', 'Ex_realizada.jpg', 'Azul'),
(2, 'Exodoncia Simple Indicada', 'Ex_simple.jpg', 'Rojo'),
(3, 'Exodoncia Quirurjica Indicada', 'Ex_quirurjica.jpg', 'Rojo'),
(4, 'Sin Erupcionar', 'Ex_quirurjica.jpg', 'Azul'),
(5, 'Endodoncia Realizada', 'End_realizada.jpg', 'Azul'),
(6, 'Endodoncia Indicada', 'End_indicada.jpg', 'Rojo'),
(7, 'Sellante Presente', 'S_presente.jpg', 'Azul'),
(8, 'Sellante Indicado', 'S_indicado.jpg', 'Rojo'),
(9, 'Erosión o Abrasión', 'E_o_A.jpg', 'Rojo'),
(10, 'Procedimiento Realizado', 'P_realizado.jpg', 'Azul'),
(11, 'Corona Buen Estado', 'C_b_E.jpg', 'Azul'),
(12, 'Corona Mal Estado', 'C_b_E.jpg', 'Rojo'),
(13, 'Provisional Buen Estado', 'P_b_E.jpg', 'Azul'),
(14, 'Provisional Mal Estado', 'P_m_E.jpg', 'Rojo'),
(15, 'Núcleo Buen Estado', 'N_m_E.jpg', 'Azul'),
(16, 'Núcleo Mal Estado', 'N_b_E.jpg', 'Rojo');

-- --------------------------------------------------------

--
-- Table structure for table `convenciones_oc`
--

CREATE TABLE `convenciones_oc` (
  `codigo` int(11) NOT NULL,
  `convencion` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `convenciones_oc`
--

INSERT INTO `convenciones_oc` (`codigo`, `convencion`, `color`) VALUES
(1, 'Cariado', 'Rojo'),
(2, 'Obturado - Amalgama', 'Azul'),
(3, 'Obturado - Resina', 'Verde');

-- --------------------------------------------------------

--
-- Table structure for table `convencion_seccion`
--

CREATE TABLE `convencion_seccion` (
  `codigo` int(11) NOT NULL,
  `codigo_convenciones_oc_FK` int(11) NOT NULL,
  `codigo_seccion_FK` int(11) NOT NULL,
  `codigo_OI_FK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `departamentos`
--

CREATE TABLE `departamentos` (
  `codigo` int(11) NOT NULL,
  `departamento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `codigo` int(11) NOT NULL,
  `codigo_consultas_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dientes`
--

CREATE TABLE `dientes` (
  `codigo` int(11) NOT NULL,
  `numero_diente` int(11) NOT NULL,
  `cuadrante` int(11) NOT NULL,
  `cuadrante_fila` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `codigo` int(11) NOT NULL,
  `fecha_evolucion` date NOT NULL,
  `codigo_cups` varchar(15) NOT NULL,
  `copago` varchar(15) NOT NULL,
  `descripcion_procedimiento` varchar(200) NOT NULL,
  `codigo_consultas_FK` int(11) NOT NULL,
  `codigo_odontograma_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `higienes`
--

CREATE TABLE `higienes` (
  `codigo` int(11) NOT NULL,
  `higieneOral` varchar(10) NOT NULL,
  `frecuencia` varchar(10) NOT NULL,
  `gradoRiesgo` varchar(10) NOT NULL,
  `sedaDental` varchar(10) NOT NULL,
  `pigmentaciones` varchar(10) NOT NULL,
  `codigo_consulta_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ips`
--

CREATE TABLE `ips` (
  `codigo` int(11) NOT NULL,
  `nombre_ips` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `codigo` int(11) NOT NULL,
  `municipio` varchar(80) NOT NULL,
  `codigo_departamento_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `codigo` int(11) NOT NULL,
  `codigoConsultaFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `o_integrado`
--

CREATE TABLE `o_integrado` (
  `codigo_odontogramas_FK` int(11) NOT NULL,
  `codigo_dientes_FK` int(11) NOT NULL,
  `codigo_convenciones_FK` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `codigo_convencionseccionFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `otrosAntecedentesFamiliares` varchar(90) DEFAULT NULL,
  `codigo_residencia_FK` int(11) NOT NULL,
  `codigo_tipo_documento_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`numero_documento`, `nombres`, `apellidoUno`, `apellidoDos`, `fecha_nacimiento`, `fecha_inicio_tratamiento`, `telefono`, `sexo`, `otrosAntecedentesFamiliares`, `codigo_residencia_FK`, `codigo_tipo_documento_FK`) VALUES
('1007597893', 'Manuel Santiago', 'Garcia', 'Julio', '1999-12-10', '2023-05-02', '3004604190', 'hombre', NULL, 34, 7),
('1007597894', 'Vanessa Antonia', 'Garcia', 'Julio', '1999-12-10', '2023-05-08', '3114167027', 'mujer', NULL, 35, 7),
('1044924492', 'Zoraida Isabel', 'Garcia', 'Julio', '2023-04-12', '2023-05-02', '3215705584', 'mujer', NULL, 27, 7),
('30761898', 'Inelda', 'Julio', 'Herrera', '1960-05-03', '2023-05-09', '+573114167027', 'mujer', NULL, 38, 7);

-- --------------------------------------------------------

--
-- Table structure for table `protesis`
--

CREATE TABLE `protesis` (
  `codigo` int(11) NOT NULL,
  `presenciaProtesis` varchar(10) NOT NULL,
  `descripcion` text,
  `tipo` text,
  `codigo_consulta_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `regimen_usuarios`
--

CREATE TABLE `regimen_usuarios` (
  `codigo_tipousuario_FK` int(11) NOT NULL,
  `codigoIps_FK` int(11) NOT NULL,
  `numero_documento_paciente_FK` varchar(20) NOT NULL,
  `sucursal` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `residencias`
--

CREATE TABLE `residencias` (
  `codigo` int(11) NOT NULL,
  `direccion_residencia` varchar(60) NOT NULL,
  `codigo_municipio_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `residencias`
--

INSERT INTO `residencias` (`codigo`, `direccion_residencia`, `codigo_municipio_FK`) VALUES
(27, 'CL LOMBA SECTOR EL SILENCIO', 64),
(34, 'Arjona bolivar. Cr 43 #48-28 ps2', 64),
(35, 'Arjona bolivar. Cr 43 #48-28 ps2', 64),
(38, 'Arjona bolivar. Cr 43 #48-28 ps2 inelda', 64);

-- --------------------------------------------------------

--
-- Table structure for table `responsables`
--

CREATE TABLE `responsables` (
  `codigo` int(11) NOT NULL,
  `aplica` varchar(5) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `parentezco` varchar(30) NOT NULL,
  `numero_documento_paciente_FK` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seccion`
--

CREATE TABLE `seccion` (
  `codigo` int(11) NOT NULL,
  `nombreSeccion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seccion`
--

INSERT INTO `seccion` (`codigo`, `nombreSeccion`) VALUES
(1, 'top'),
(2, 'buttom'),
(3, 'left'),
(4, 'right'),
(5, 'center');

-- --------------------------------------------------------

--
-- Table structure for table `tipos_diagnosticos`
--

CREATE TABLE `tipos_diagnosticos` (
  `codigo` int(11) NOT NULL,
  `diagnostico` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tipos_documentos`
--

CREATE TABLE `tipos_documentos` (
  `codigo` int(11) NOT NULL,
  `clase_de_documento` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `codigo` int(11) NOT NULL,
  `clase_de_usuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD KEY `codigo_consultas_FK_4` (`codigo_consultas_FK`);

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
  ADD KEY `codigo_consultas_FK_1` (`codigo_consultas_FK`);

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
  ADD KEY `codigo_consulta_FK_3` (`codigo_consulta_FK`);

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
-- Indexes for table `protesis`
--
ALTER TABLE `protesis`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_consulta_FK_4` (`codigo_consulta_FK`);

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
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `antecedentes_familiares`
--
ALTER TABLE `antecedentes_familiares`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `articulaciones_temporo_mandibulares`
--
ALTER TABLE `articulaciones_temporo_mandibulares`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `codigos_cies`
--
ALTER TABLE `codigos_cies`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

--
-- AUTO_INCREMENT for table `consultas`
--
ALTER TABLE `consultas`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `convenciones`
--
ALTER TABLE `convenciones`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `convenciones_oc`
--
ALTER TABLE `convenciones_oc`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `convencion_seccion`
--
ALTER TABLE `convencion_seccion`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `diagnosticos`
--
ALTER TABLE `diagnosticos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dientes`
--
ALTER TABLE `dientes`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `evoluciones_h_c`
--
ALTER TABLE `evoluciones_h_c`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `higienes`
--
ALTER TABLE `higienes`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ips`
--
ALTER TABLE `ips`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `municipios`
--
ALTER TABLE `municipios`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1101;

--
-- AUTO_INCREMENT for table `odontogramas`
--
ALTER TABLE `odontogramas`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `o_integrado`
--
ALTER TABLE `o_integrado`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `protesis`
--
ALTER TABLE `protesis`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residencias`
--
ALTER TABLE `residencias`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `responsables`
--
ALTER TABLE `responsables`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seccion`
--
ALTER TABLE `seccion`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tipos_diagnosticos`
--
ALTER TABLE `tipos_diagnosticos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `codigo_consultas_FK_4` FOREIGN KEY (`codigo_consultas_FK`) REFERENCES `consultas` (`codigo`);

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
  ADD CONSTRAINT `codigoOI_FK` FOREIGN KEY (`codigo_OI_FK`) REFERENCES `o_integrado` (`codigo`),
  ADD CONSTRAINT `codigo_convenciones_oc_FK_1` FOREIGN KEY (`codigo_convenciones_oc_FK`) REFERENCES `convenciones_oc` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codigo_seccion_FK_1` FOREIGN KEY (`codigo_seccion_FK`) REFERENCES `seccion` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diagnosticos`
--
ALTER TABLE `diagnosticos`
  ADD CONSTRAINT `codigo_consultas_FK_1` FOREIGN KEY (`codigo_consultas_FK`) REFERENCES `consultas` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `codigo_consulta_FK_3` FOREIGN KEY (`codigo_consulta_FK`) REFERENCES `consultas` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `codigo_departamento_FK` FOREIGN KEY (`codigo_departamento_FK`) REFERENCES `departamentos` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `odontogramas`
--
ALTER TABLE `odontogramas`
  ADD CONSTRAINT `codigo_consulta_FK3` FOREIGN KEY (`codigoConsultaFK`) REFERENCES `consultas` (`codigo`);

--
-- Constraints for table `o_integrado`
--
ALTER TABLE `o_integrado`
  ADD CONSTRAINT `Codigo_convencionseccionFK` FOREIGN KEY (`codigo_convencionseccionFK`) REFERENCES `convencion_seccion` (`codigo`),
  ADD CONSTRAINT `codigo_convenciones_FK` FOREIGN KEY (`codigo_convenciones_FK`) REFERENCES `convenciones` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `codigo_consulta_FK_4` FOREIGN KEY (`codigo_consulta_FK`) REFERENCES `consultas` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regimen_usuarios`
--
ALTER TABLE `regimen_usuarios`
  ADD CONSTRAINT `codigoIps_FK` FOREIGN KEY (`codigoIps_FK`) REFERENCES `ips` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codigo_tipousuario_FK` FOREIGN KEY (`codigo_tipousuario_FK`) REFERENCES `tipos_usuarios` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
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
