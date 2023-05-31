[1mdiff --git a/tests/mock/abstractions/AbstractImplementationOfInterfaceForClassThatDefinesMethods.php b/tests/mock/abstractions/AbstractImplementationOfInterfaceForClassThatDefinesMethods.php[m
[1mindex 5598dc3..6226fad 100644[m
[1m--- a/tests/mock/abstractions/AbstractImplementationOfInterfaceForClassThatDefinesMethods.php[m
[1m+++ b/tests/mock/abstractions/AbstractImplementationOfInterfaceForClassThatDefinesMethods.php[m
[36m@@ -5,11 +5,10 @@[m [mnamespace Darling\PHPMockingUtilities\tests\mock\abstractions;[m
 use \Darling\PHPMockingUtilities\tests\mock\interfaces\InterfaceForClassThatDefinesMethods;[m
 [m
 /**[m
[31m- * The following classes are defined here for use by[m
[31m- * the MockClassInstanceTest[m
[32m+[m[32m * The following class is defined here for use by the[m
[32m+[m[32m * MockClassInstanceTest[m
  *[m
  */[m
[31m-[m
 abstract class AbstractImplementationOfInterfaceForClassThatDefinesMethods implements InterfaceForClassThatDefinesMethods[m
 {[m
 }[m
[1mdiff --git a/tests/mock/classes/ClassThatDoesNotDefineMethods.php b/tests/mock/classes/ClassThatDoesNotDefineMethods.php[m
[1mindex e18061e..9d77dfc 100644[m
[1m--- a/tests/mock/classes/ClassThatDoesNotDefineMethods.php[m
[1m+++ b/tests/mock/classes/ClassThatDoesNotDefineMethods.php[m
[36m@@ -2,6 +2,11 @@[m
 [m
 namespace Darling\PHPMockingUtilities\tests\mock\classes;[m
 [m
[32m+[m[32m/**[m
[32m+[m[32m * The following class is defined here for use by the[m
[32m+[m[32m * MockClassInstanceTest[m
[32m+[m[32m *[m
[32m+[m[32m */[m
 class ClassThatDoesNotDefineMethods[m
 {[m
 [m
[1mdiff --git a/tests/mock/classes/ImplementationOfInterfaceForClassThatDefinesMethods.php b/tests/mock/classes/ImplementationOfInterfaceForClassThatDefinesMethods.php[m
[1mindex 94c59c6..e64cd70 100644[m
[1m--- a/tests/mock/classes/ImplementationOfInterfaceForClassThatDefinesMethods.php[m
[1m+++ b/tests/mock/classes/ImplementationOfInterfaceForClassThatDefinesMethods.php[m
[36m@@ -6,11 +6,10 @@[m [muse \Darling\PHPMockingUtilities\tests\mock\interfaces\InterfaceForClassThatDefi[m
 use \Darling\PHPMockingUtilities\tests\mock\abstractions\AbstractImplementationOfInterfaceForClassThatDefinesMethods;[m
 [m
 /**[m
[31m- * The following classes are defined here for use by[m
[31m- * the MockClassInstanceTest[m
[32m+[m[32m * The following class is defined here for use by the[m
[32m+[m[32m * MockClassInstanceTest[m
  *[m
  */[m
[31m-[m
 class ImplementationOfInterfaceForClassThatDefinesMethods extends AbstractImplementationOfInterfaceForClassThatDefinesMethods implements InterfaceForClassThatDefinesMethods[m
 {[m
     /**[m
[1mdiff --git a/tests/mock/interfaces/InterfaceForClassThatDefinesMethods.php b/tests/mock/interfaces/InterfaceForClassThatDefinesMethods.php[m
[1mindex e29549f..6a1a392 100644[m
[1m--- a/tests/mock/interfaces/InterfaceForClassThatDefinesMethods.php[m
[1m+++ b/tests/mock/interfaces/InterfaceForClassThatDefinesMethods.php[m
[36m@@ -5,8 +5,8 @@[m [mnamespace Darling\PHPMockingUtilities\tests\mock\interfaces;[m
 use \Darling\PHPMockingUtilities\tests\mock\abstractions\AbstractImplementationOfInterfaceForClassThatDefinesMethods;[m
 [m
 /**[m
[31m- * The following classes are defined here for use by[m
[31m- * the MockClassInstanceTest[m
[32m+[m[32m * The following interface is defined here for use by the[m
[32m+[m[32m * MockClassInstanceTest[m
  *[m
  */[m
 [m
