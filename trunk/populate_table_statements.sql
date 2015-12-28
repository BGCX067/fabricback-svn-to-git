-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: 192.168.1.104
-- Generation Time: Apr 27, 2010 at 09:16 PM
-- Server version: 5.0.77
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fabricba_exammgmt`
--

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`USERNAME`, `PASSWORD`, `TITLE`) VALUES
('admin', 'mummy', 'Administrator');

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`UNIQUE_COURSE_ID`, `SECTION`, `COURSENUM`, `SEMESTER`, `YEAR`, `TITLE`, `INSTR_ID`) VALUES
(1, 'C', 4400, 'Spring', 2010, 'Database Systems', 2),
(2, 'A', 101, 'Fall', 2010, 'Awesomeness', 3),
(3, 'D', 4400, 'Spring', 2010, 'Database Systems', 4),
(4, 'C', 4400, 'Spring', 2010, 'Database Systems', 3),
(5, 'AB', 1316, 'Fall', 2009, 'Representational Structure', 4),
(6, 'B', 4400, 'Summer', 2010, 'CS: Fundamentals of Datab', 5),
(7, 'C', 1371, 'Spring', 2009, 'Programming for Engineering', 4),
(8, 'B', 3133, 'Spring', 2010, 'Engineering Optimization', 4);

--
-- Dumping data for table `instr_user`
--

INSERT INTO `instr_user` (`INSTR_ID`, `USERNAME`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`) VALUES
(2, 'jason', 'test1', 'Jason', 'Bapna'),
(3, 'hjangla3', 'cookiemonster', 'Heta', 'Jangla'),
(4, 'nshah63', 'databases', 'Nirmit', 'Shah'),
(5, 'dchopra3', 'dhruvisawesome', 'Dhruv', 'Chopra');

--
-- Dumping data for table `mc_ans_wrong`
--

INSERT INTO `mc_ans_wrong` (`QUESTION_ID`, `WRONG_ANS_ID`, `WRONG_ANS_TEXT`) VALUES
(17, 65, 'Reduce the redundant values in tuples'),
(17, 66, 'Reduce the null values in tuples'),
(17, 67, 'Disallow the potential for generating spurious tuples'),
(17, 68, ''),
(17, 69, ''),
(17, 70, ''),
(17, 71, ''),
(17, 72, ''),
(18, 73, 'All'),
(18, 74, 'DeptNo must be a primary key for DeptSales '),
(18, 75, 'DeptNo must be a superkey for DeptSales'),
(18, 76, ''),
(18, 77, ''),
(18, 78, ''),
(18, 79, ''),
(18, 80, ''),
(19, 81, 'F1 and F2 contain no redundant functional dependencies '),
(19, 82, 'F2 is a subset of F1'),
(19, 83, 'F1 and F2 have the same number of functional dependencies '),
(19, 84, ''),
(19, 85, ''),
(19, 86, ''),
(19, 87, ''),
(19, 88, ''),
(20, 89, 'It represents some aspect of the real world'),
(20, 90, 'It is a logically coherent collection of data with some inherent meaning'),
(20, 91, 'It is designed, built and populated with data for a specific purpose'),
(20, 92, ''),
(20, 93, ''),
(20, 94, ''),
(20, 95, ''),
(20, 96, ''),
(21, 97, 'Application data'),
(21, 98, 'External data'),
(21, 99, 'Temporal data'),
(21, 100, ''),
(21, 101, ''),
(21, 102, ''),
(21, 103, ''),
(21, 104, ''),
(23, 113, 'Access data without a program'),
(23, 114, 'Write a program to access any piece of data'),
(23, 115, 'Define data in your program'),
(23, 116, ''),
(23, 117, ''),
(23, 118, ''),
(23, 119, ''),
(23, 120, ''),
(24, 121, 'yes'),
(24, 122, ''),
(24, 123, ''),
(24, 124, ''),
(24, 125, ''),
(24, 126, ''),
(24, 127, ''),
(24, 128, ''),
(25, 129, 'no'),
(25, 130, ''),
(25, 131, ''),
(25, 132, ''),
(25, 133, ''),
(25, 134, ''),
(25, 135, ''),
(25, 136, ''),
(26, 137, 'A subset of the database '),
(26, 138, 'Virtual data that is derived from the database'),
(26, 139, 'None'),
(26, 140, ''),
(26, 141, ''),
(26, 142, ''),
(26, 143, ''),
(26, 144, ''),
(27, 145, 'R1(A,B)  and R2(B,D)  and R3(B,C) '),
(27, 146, 'R1(A,B)  and R2(B,C)  and R3(C,D) '),
(27, 147, 'None'),
(27, 148, ''),
(27, 149, ''),
(27, 150, ''),
(27, 151, ''),
(27, 152, ''),
(28, 153, 'first normal form'),
(28, 154, 'second normal form'),
(28, 155, 'third normal form'),
(28, 156, ''),
(28, 157, ''),
(28, 158, ''),
(28, 159, ''),
(28, 160, ''),
(30, 161, '11500ms'),
(30, 162, '13500ms'),
(30, 163, '580ms'),
(30, 164, ''),
(30, 165, ''),
(30, 166, ''),
(30, 167, ''),
(30, 168, ''),
(31, 169, 'Every course must have a unique value for its course number '),
(31, 170, 'The name of any student must be less than 30 characters in length'),
(31, 171, 'The grade assigned to a student for a course must be either an A, B, C, D or F'),
(31, 172, ''),
(31, 173, ''),
(31, 174, ''),
(31, 175, ''),
(31, 176, ''),
(32, 177, '100,000'),
(32, 178, '3000'),
(32, 179, '2048'),
(32, 180, ''),
(32, 181, ''),
(32, 182, ''),
(32, 183, ''),
(32, 184, ''),
(33, 185, '1250'),
(33, 186, '100000'),
(33, 187, '10000'),
(33, 188, ''),
(33, 189, ''),
(33, 190, ''),
(33, 191, ''),
(33, 192, ''),
(34, 193, 'Disallow the potential for generating spurious tuples'),
(34, 194, 'All of the above'),
(34, 195, 'Reduce the redundant values in tuples'),
(34, 196, ''),
(34, 197, ''),
(34, 198, ''),
(34, 199, ''),
(34, 200, ''),
(35, 201, 'If two tuples have the same value for DeptNo then they have the same value for Dname'),
(35, 202, 'All of the above '),
(35, 203, 'Disallow the potential for generating spurious tuples'),
(35, 204, ''),
(35, 205, ''),
(35, 206, ''),
(35, 207, ''),
(35, 208, ''),
(36, 209, 'Both'),
(36, 210, 'None'),
(36, 211, 'find a dependency preserving decomposition of the relation into BCNF'),
(36, 212, ''),
(36, 213, ''),
(36, 214, ''),
(36, 215, ''),
(36, 216, ''),
(37, 217, 'F2 is a subset of F1'),
(37, 218, 'F1 and F2 have the same number of functional dependencies '),
(37, 219, 'None of the above  '),
(37, 220, ''),
(37, 221, ''),
(37, 222, ''),
(37, 223, ''),
(37, 224, ''),
(38, 225, 'BCâ†’D '),
(38, 226, 'Both'),
(38, 227, 'None'),
(38, 228, ''),
(38, 229, ''),
(38, 230, ''),
(38, 231, ''),
(38, 232, ''),
(39, 233, '2nd'),
(39, 234, '3rd'),
(39, 235, 'Boyce-Codd'),
(39, 236, ''),
(39, 237, ''),
(39, 238, ''),
(39, 239, ''),
(39, 240, ''),
(40, 241, 'find a lossless join decomposition of the relation into BCNF'),
(40, 242, 'both'),
(40, 243, 'none'),
(40, 244, ''),
(40, 245, ''),
(40, 246, ''),
(40, 247, ''),
(40, 248, ''),
(42, 249, 'One or more fields within a record may be of varying size'),
(42, 250, 'One or more fields may have multiple values within one record  '),
(42, 251, 'One or more fields within a record may be optional'),
(42, 252, ''),
(42, 253, ''),
(42, 254, ''),
(42, 255, ''),
(42, 256, ''),
(43, 257, '4,902'),
(43, 258, '490'),
(43, 259, '49,020'),
(43, 260, ''),
(43, 261, ''),
(43, 262, ''),
(43, 263, ''),
(43, 264, ''),
(45, 265, '3'),
(45, 266, '2'),
(45, 267, '1'),
(45, 268, ''),
(45, 269, ''),
(45, 270, ''),
(45, 271, ''),
(45, 272, ''),
(46, 273, 'no'),
(46, 274, ''),
(46, 275, ''),
(46, 276, ''),
(46, 277, ''),
(46, 278, ''),
(46, 279, ''),
(46, 280, ''),
(47, 281, 'no'),
(47, 282, ''),
(47, 283, ''),
(47, 284, ''),
(47, 285, ''),
(47, 286, ''),
(47, 287, ''),
(47, 288, '');

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`QUESTION_ID`, `QUESTION_TEXT`, `QUESTION_POINTS`, `QUESTION_TYPE`, `INSTR_ID`, `TOPIC_ID`, `QUESTION_ANS`) VALUES
(17, 'Which of the following are informal design guidelines for relational schema?', 1, 'MCQ', 4, 4, 'All'),
(18, 'What constraint does the one functional dependency DeptNo â†’ Dname define for the relation schema DeptSales(DeptNo, Dname, Month, Year, Sales)?  ', 1, 'MCQ', 4, 4, 'If two tuples have the same value for DeptNo then they have the same value for Dname'),
(19, 'Two sets of functional dependencies, F1 and F2 are equivalent if ', 1, 'MCQ', 4, 4, 'None'),
(20, 'Which of the following are properties of a database? ', 1, 'MCQ', 5, 5, 'All the options'),
(21, 'The information stored in the DBMS catalog is often referred to as', 1, 'MCQ', 5, 5, 'Meta-data'),
(23, 'Program-data independence refers to the ability to ', 1, 'MCQ', 5, 5, 'Change the structure of the data files without having to change the programs that access the data files '),
(24, 'Are the two sets of functional dependencies {ABâ†’C;   BCâ†’D;    Aâ†’B} and {Aâ†’C;    Câ†’D;    Dâ†’B} equivalent?', 1, 'MCQ', 4, 6, 'no'),
(25, 'Given the relation schema R(A,B,C,D) with FDs {ABâ†’C;   ABâ†’D;   CDâ†’A;     CDâ†’B}.  Is relation schema R in BCNF? ', 1, 'MCQ', 4, 6, 'yes'),
(26, 'A view may be ', 1, 'MCQ', 5, 5, 'Both the options'),
(27, 'The BCNF decomposition algorithm could produce the following results for relational schema R(A,B,C,D) with the FDs {Aâ†’B;   Bâ†’C;   Câ†’D}.', 1, 'MCQ', 4, 6, 'Both'),
(28, '12.	The highest normal form for relation schema R(A,B,C) with functional       dependencies F = {ABâ†’ C;     Bâ†’A;    Câ†’B } is  ', 1, 'MCQ', 4, 6, 'BCNF'),
(29, 'Is the join of the two relations R1(A,B) and R2(A,C,D) lossless, given the functional dependencies F = {Aâ†’C;    Dâ†’B;    ACâ†’B}. ', 1, 'TF', 4, 6, 'true'),
(30, 'Consider a disk pack with 4 platters, 8 read-write heads, 49,854 cylinders, a block size of 4096 bytes, an average seek time of 5ms, an average rotational delay of 3ms, a block transfer time of 0.5ms.', 3, 'MCQ', 4, 7, '8500ms'),
(31, 'Which of the following is an example of a database integrity constraint?', 1, 'MCQ', 5, 5, 'all the options'),
(32, 'Consider an unordered file of 100,000 records with a record size of 100 bytes stored on blocks of 4096 bytes with an unspanned record organization.   We will assume that no system related information ', 1, 'MCQ', 4, 7, '2500'),
(33, 'Consider an unordered file of 100,000 records with a record size of 100 bytes stored on  blocks of 4096 bytes with an unspanned record organization.   We will assume that no system related information', 1, 'MCQ', 4, 7, '1500'),
(34, 'Which of the following are informal design guidelines for relational schema?', 1, 'MCQ', 5, 8, 'Reduce the null values in tuples'),
(35, 'What constraint does the one functional dependency DeptNo ï‚® Dname define for the relation schema DeptSales(DeptNo, Dname, Month, Year, Sales)?  ', 1, 'MCQ', 5, 8, 'DeptNo must be a superkey for DeptSales'),
(36, 'Given a relation schema and associated functional dependencies, it is always possible to  ', 1, 'MCQ', 4, 6, 'Find a lossless join decomposition of the relation into BCNF'),
(37, 'Two sets of functional dependencies, F1 and F2 are equivalent if ', 1, 'MCQ', 5, 8, 'F1 and F2 contain no redundant functional dependencies '),
(38, ' Consider the relation schema R(A,B,C,D) with FDs F = {ABâ†’C;   BCâ†’D;    Aâ†’B}.  Which FD has an extraneous attribute on the left hand side? ', 1, 'MCQ', 4, 6, 'ABâ†’C'),
(39, 'The highest normal form that a relation with no nontrivial functions dependencies can be in is ', 1, 'MCQ', 5, 8, '1st'),
(40, 'Given a relation schema and associated functional dependencies, it is always possible to  ', 1, 'MCQ', 5, 8, 'find a dependency preserving decomposition of the relation into BCNF'),
(41, 'Is every relation in 3rd normal form (3NF) also in Boyce Codd normal form (BCNF)? ', 1, 'TF', 5, 8, 'true'),
(42, 'Variable length records within a file may exist because  ', 1, 'MCQ', 4, 7, 'All'),
(43, 'Consider an unordered file with 100,000,000 records with a record size of 400 bytes stored with  an unspanned record organization.  We will assume that no system related information is stored within a', 1, 'MCQ', 4, 7, '490,200'),
(45, 'How many tuples are returned by the following SQL query?       Select Salary From Employee;  ', 1, 'MCQ', 4, 9, '5'),
(46, 'Is it allowable to define more than one foreign key for a single relation in an SQL Create Table statement?', 1, 'MCQ', 4, 9, 'yes'),
(47, 'Can we define a table, which has no key, using the SQL CREATE TABLE statement? ', 1, 'MCQ', 4, 9, 'yes');

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`TESTID`, `UNIQUE_COURSE_ID`, `TEST_TITLE`) VALUES
(1, 1, 'Quiz 1'),
(2, 2, 'Are you awesome?'),
(3, 3, 'Quiz 1'),
(7, 3, 'Quiz 2'),
(4, 5, 'Exam 1'),
(6, 6, 'Final Exam');

--
-- Dumping data for table `test_to_question`
--

INSERT INTO `test_to_question` (`TESTID`, `QUESTION_ID`) VALUES
(6, 17),
(7, 17),
(3, 18),
(4, 19),
(6, 19),
(4, 20),
(7, 20),
(3, 21),
(4, 23),
(3, 24),
(4, 24),
(7, 24),
(6, 25),
(7, 25),
(7, 27),
(3, 28),
(7, 28),
(7, 29),
(1, 30),
(3, 30),
(4, 31),
(1, 32),
(6, 32),
(3, 33),
(3, 34),
(4, 34),
(4, 35),
(7, 36),
(6, 38),
(7, 38),
(4, 39),
(4, 40),
(1, 41),
(3, 43),
(4, 45),
(4, 46),
(4, 47);

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`TOPIC_ID`, `NAME`) VALUES
(8, 'Database Design'),
(7, 'Disk Storage'),
(6, 'Functional Dependencies'),
(5, 'Properties of Databases'),
(4, 'Referential Integrity'),
(9, 'SQL');
