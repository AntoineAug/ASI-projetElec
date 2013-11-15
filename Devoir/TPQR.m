eps=10^-12
B=[1 1 1;eps 0 0; 0 eps 0; 0 0 eps];
xv=[3;-1;1];

d= B*xv

%%
%x1=inv(B)*d; %impossible matrice non carrée
%D= det(B'*B); % donc non inversible

%R= rank(B);

%x= inv(B'*B)*B'*d;

x= B\d

[Q R]= qr(B);

Rc=R(1:3,:);
Qc=Q(:,1:3);

x= Rc\(Qc'*d)

%% Mon qr
B=[1 1 1;eps 0 0; 0 eps 0; 0 0 eps];

[Q,R]=QR_BBD(B)
