EESchema Schematic File Version 2  date 09/11/2013 23:31:08
LIBS:power
LIBS:device
LIBS:transistors
LIBS:conn
LIBS:linear
LIBS:regul
LIBS:74xx
LIBS:cmos4000
LIBS:adc-dac
LIBS:memory
LIBS:xilinx
LIBS:special
LIBS:microcontrollers
LIBS:dsp
LIBS:microchip
LIBS:analog_switches
LIBS:motorola
LIBS:texas
LIBS:intel
LIBS:audio
LIBS:interface
LIBS:digital-audio
LIBS:philips
LIBS:display
LIBS:cypress
LIBS:siliconi
LIBS:opto
LIBS:atmel
LIBS:contrib
LIBS:valves
LIBS:7805
LIBS:Shield_Arduino
LIBS:RASPBERRY_IO
EELAYER 27 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 1 1
Title ""
Date "9 nov 2013"
Rev ""
Comp ""
Comment1 ""
Comment2 ""
Comment3 ""
Comment4 ""
$EndDescr
$Comp
L 7805 U1
U 1 1 527EA8B3
P 2750 2800
F 0 "U1" H 2900 2604 60  0000 C CNN
F 1 "7805" H 2750 3000 60  0000 C CNN
F 2 "~" H 2750 2800 60  0000 C CNN
F 3 "~" H 2750 2800 60  0000 C CNN
	1    2750 2800
	1    0    0    -1  
$EndComp
$Comp
L VCC #PWR?
U 1 1 527EB144
P 2200 2650
F 0 "#PWR?" H 2200 2750 30  0001 C CNN
F 1 "VCC" H 2200 2750 30  0000 C CNN
F 2 "" H 2200 2650 60  0000 C CNN
F 3 "" H 2200 2650 60  0000 C CNN
	1    2200 2650
	1    0    0    -1  
$EndComp
Wire Wire Line
	2200 2650 2200 2750
Wire Wire Line
	2200 2750 2350 2750
Wire Wire Line
	7500 2750 7500 3850
Wire Wire Line
	4350 4300 3700 4300
Wire Wire Line
	3700 4300 3700 2750
Connection ~ 3700 2750
Wire Wire Line
	2750 3050 2750 4400
Wire Wire Line
	2750 4400 4350 4400
Wire Wire Line
	3950 4400 3950 5950
Connection ~ 3950 4400
Wire Wire Line
	3150 2750 7500 2750
Wire Wire Line
	3950 5950 7800 5950
Wire Wire Line
	7800 4050 7500 4050
Wire Wire Line
	7800 5950 7800 4050
$Comp
L RASPBERRY_IO RPi?
U 1 1 527EB308
P 7100 4450
F 0 "RPi?" H 7100 5150 60  0000 C CNN
F 1 "RASPBERRY_IO" V 7100 4450 50  0000 C CNN
F 2 "" H 7100 4450 60  0000 C CNN
F 3 "" H 7100 4450 60  0000 C CNN
	1    7100 4450
	1    0    0    -1  
$EndComp
$Comp
L ARDUINO_SHIELD SHIELD?
U 1 1 527EB1D1
P 5300 4500
F 0 "SHIELD?" H 4950 5450 60  0000 C CNN
F 1 "ARDUINO_SHIELD" H 5350 3550 60  0000 C CNN
F 2 "" H 5300 4500 60  0000 C CNN
F 3 "" H 5300 4500 60  0000 C CNN
	1    5300 4500
	1    0    0    -1  
$EndComp
$Comp
L 7805 U1
U 1 1 527EB4C8
P 9250 3300
F 0 "U1" H 9400 3104 60  0000 C CNN
F 1 "7805" H 9250 3500 60  0000 C CNN
F 2 "~" H 9250 3300 60  0000 C CNN
F 3 "~" H 9250 3300 60  0000 C CNN
	1    9250 3300
	1    0    0    -1  
$EndComp
$Comp
L CONN_2 P1
U 1 1 527EB52E
P 8800 4250
F 0 "P1" V 8750 4250 40  0000 C CNN
F 1 "CONN_2" V 8850 4250 40  0000 C CNN
F 2 "" H 8800 4250 60  0000 C CNN
F 3 "" H 8800 4250 60  0000 C CNN
	1    8800 4250
	0    -1   1    0   
$EndComp
Wire Wire Line
	8900 3550 9700 3550
Wire Wire Line
	8900 3550 8900 3900
Wire Wire Line
	9700 3550 9700 3900
Connection ~ 9250 3550
Wire Wire Line
	8850 3250 8700 3250
Wire Wire Line
	8700 3250 8700 3900
Wire Wire Line
	9650 3250 9900 3250
Wire Wire Line
	9900 3250 9900 3900
$Comp
L CONN_4 P2
U 1 1 527EB6CC
P 9850 4250
F 0 "P2" V 9800 4250 50  0000 C CNN
F 1 "CONN_4" V 9900 4250 50  0000 C CNN
F 2 "" H 9850 4250 60  0000 C CNN
F 3 "" H 9850 4250 60  0000 C CNN
	1    9850 4250
	0    1    1    0   
$EndComp
Wire Wire Line
	9700 3650 9800 3650
Wire Wire Line
	9800 3650 9800 3900
Connection ~ 9700 3650
Wire Wire Line
	9900 3650 10000 3650
Wire Wire Line
	10000 3650 10000 3900
Connection ~ 9900 3650
$EndSCHEMATC
