clear all
close all

%% Fun with sounds

[X,FS,NBITS]=wavread('Voice4000.wav');

Te=1/FS;
TeCible=1/44100;
Y = [0:Te:Te*(length(X) -1)];
YInterp = [0:TeCible:Te*(length(X) -1)];

XInterp = interp1(Y, X, YInterp);

wavwrite(XInterp, 1/TeCible, 'voice441.wav')