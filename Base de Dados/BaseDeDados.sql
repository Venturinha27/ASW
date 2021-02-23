CREATE TABLE RegistoVoluntarios (
    nomeProprio varchar(10),
    dataNascimento date, 
    genero varchar(255),         --tipo errado
    foto varbinary(max),           
    concelho varchar(50)
    distrito varchar(50)
    freguesia varchar(50)
    telefone numeric(15)
    CC numeric(8)
    CartaC varchar(255)         --tipo errado
    Covid varchar(255)          --tipo errado
    E-mail nvarchar(255)
    password1 varchar(20)
);


CREATE TABLE RegistoInstituicoes (
    nomeInstituicao varchar(15),
    descricao varchar(200),
    telefone numeric(15)
    morada varchar(100)
    distrito varchar(50)
    concelho varchar(50)
    freguesia varchar(50)
    E-mail nvarchar(255)
    website varchar(50)
    nomeRepresentante varchar(15),
    emailRepresentante nvarchar(255)
    password2 varchar(20)
);
