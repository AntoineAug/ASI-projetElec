clear all
close all

%%
To=0.001;
fo= 5;
t=-2:To:2;

%xr=fo*sinc_asi(fo*t);

x = sin(pi*fo*t)./(pi * t);

figure(1)
plot(t, x)

%% Échantillonnage idéal
Fe1 = fo;
t1 = -2:1/Fe1:2;
x1 = sin(pi*fo*t1)./(pi * t1); 

Fe2 = fo*2;
t2 = -2:1/Fe2:2;
x2 = sin(pi*fo*t2)./(pi * t2);

Fe3 = (3/2)*fo;
t3 = -2:1/Fe3:2;
x3 = sin(pi*fo*t3)./(pi * t3);

figure(2)
hold on
stem(t1, x1, 'b')
stem(t2, x2, 'r')
stem(t3, x3, 'g')
hold off;

%À fo, aucun résultat exploitable. À partir de 3/2 de fo ça commence en aller
% pour 5fo le résultat est quasiment exploitable.

%% Échantillonnage réél
n= length(t);
Te= 1/(2*fo);
Te1=1/(12*fo);
Te2=1/fo;
Te3=1/((3/2)*fo);

xe=ech_reel(Te,To)/To;
xe1=ech_reel(Te1,To)/To;
xe2=ech_reel(Te2,To)/To;
xe3=ech_reel(Te3,To)/To;

tm=linspace(-2,2,length(xe));
tm1=linspace(-2,2,length(xe1));
tm2=linspace(-2,2,length(xe2));
tm3=linspace(-2,2,length(xe3));

figure(3)

subplot(2,2,1)
stem(tm,xe) 
subplot(2,2,2)
stem(tm1,xe1)
subplot(2,2,3)
stem(tm2,xe2)
subplot(2,2,4)
stem(tm3,xe3)

%Idem question précédente. L'echantillonnage réél dépend de Te. Si la
%fréquence Fe respecte la condition du théorème de Shannon, alors on obtien
%alors la bonne courbe. Aussi, lorsqu'on augment le second paramètre :
%delta, on obtient des résultats dégueulasses.

%% Reconstruction

Fe=2*fo;
Te=1/Fe;
t4=-2:1/Fe:2;
t5=-2:(1/Fe)*(1/Fe):2;
x = sin(pi*fo*t4)./(pi * t4);
y= fo*x;

yr=0;

for n=1:1:length(y)-1
    for m=1:1:Fe
        yr = [yr, y(n)];
    end
end

figure(4)
plot(t4,y);
hold on
plot(t5,yr,'r');
hold off

