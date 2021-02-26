CREATE TABLE Voluntarios (
    nomeProprio varchar(10),
    dataNascimento date, 
    genero varchar(255),         
    foto varbinary(max),           
    concelho varchar(50),
    distrito varchar(50),
    freguesia varchar(50),
    telefone numeric(15),
    CC numeric(8) UNIQUE,
    CartaC varchar(255),        
    Covid varchar(255),         
    E-mail nvarchar(255),
    password1 varchar(20),
);


