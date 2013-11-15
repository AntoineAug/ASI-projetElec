function [Q, R]= QR_BBD(A)
    n = length(A);
    
    for i = 1:n 
        % on calcul alpha
        alpha = - norm(A(:, i), 2);
        
        % on frome le vecteur e
        e = zeros(length(A),1);
        e(i)=1;
        
        % on calcul V
        V=A(i:n, i) + alpha * e;
        
        %
        H =[eye(1:i-1,1:i-1) zeros(1:i-1,i:n) ;zeros(i:n,1:i-1) eye(n-i+1) - (2/(V'*V))*V*V'];
        A = H*A
end
        