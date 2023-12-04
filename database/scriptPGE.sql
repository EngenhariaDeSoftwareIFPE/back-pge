create database PGE;

use PGE;

CREATE TABLE Aluno (
    matriculaAluno VARCHAR(20) PRIMARY KEY NOT NULL,
    nomeAluno VARCHAR(50) NOT NULL,
    cursoAluno VARCHAR(30) NOT NULL,
    emailAluno VARCHAR(30) NOT NULL
);

CREATE TABLE ProfOrientador (
    matriculaProf VARCHAR(20) PRIMARY KEY,
    nomeProf VARCHAR(50) NOT NULL,
    cursoProf VARCHAR(30) NOT NULL
);

CREATE TABLE Documentacao (
    nomeDoc VARCHAR(20) NOT NULL,
    idDoc INTEGER auto_increment PRIMARY KEY,
    dataUploadDoc DATE,
    statusDoc BOOLEAN NOT NULL,
    fk_Aluno_matriculaAluno VARCHAR(20)
);

CREATE TABLE Signatario (
    idSign INTEGER auto_increment PRIMARY KEY NOT NULL,
    nomeSign VARCHAR(50) NOT NULL,
    fk_Cargo_idCargo INTEGER NOT NULL
);

CREATE TABLE Frequencia (
    idFreq INTEGER auto_increment PRIMARY KEY NOT NULL,
    horasTotaisFreq INTEGER NOT NULL,
    horasTrabalhadasFreq FLOAT NOT NULL,
    fk_Aluno_matriculaAluno VARCHAR(20)
);

CREATE TABLE CoordEstag (
    matriculaCoord VARCHAR(20) PRIMARY KEY NOT NULL,
    nomeCoord VARCHAR(50) NOT NULL,
    cursoCoord VARCHAR(30) NOT NULL
);

CREATE TABLE Estagio (
    idEstag INTEGER auto_increment PRIMARY KEY NOT NULL,
    statusEstag VARCHAR(20) NOT NULL,
    tituloEstag VARCHAR(50) NOT NULL,
    fk_Aluno_matriculaAluno VARCHAR(20),
    fk_ProfOrientador_matriculaProf VARCHAR(20),
    fk_CoordEstag_matriculaCoord VARCHAR(20)
);

CREATE TABLE Cargo (
    idCargo INTEGER auto_increment PRIMARY KEY NOT NULL,
    nomeCargo VARCHAR(20) NOT NULL
);

CREATE TABLE Notificacao (
    idNotif INTEGER auto_increment PRIMARY KEY NOT NULL,
    horaNotif TIME,
    dataNotif DATE,
    descriNotif VARCHAR(50) NOT NULL,
    tituloNotif VARCHAR(30) NOT NULL,
    lidaNotif BOOLEAN NOT NULL,
    fk_Aluno_matriculaAluno VARCHAR(20)
);

CREATE TABLE Assina (
    fk_Documentacao_idDoc INTEGER,
    fk_Signatario_idSign INTEGER,
    dataAssina DATE,
    horarioAssina TIME
);
 
ALTER TABLE Documentacao ADD CONSTRAINT FK_Documentacao_2
    FOREIGN KEY (fk_Aluno_matriculaAluno)
    REFERENCES Aluno (matriculaAluno)
    ON DELETE RESTRICT;
 
ALTER TABLE Signatario ADD CONSTRAINT FK_Signatario_2
    FOREIGN KEY (fk_Cargo_idCargo)
    REFERENCES Cargo (idCargo)
    ON DELETE RESTRICT;
 
ALTER TABLE Frequencia ADD CONSTRAINT FK_Frequencia_2
    FOREIGN KEY (fk_Aluno_matriculaAluno)
    REFERENCES Aluno (matriculaAluno)
    ON DELETE CASCADE;
 
ALTER TABLE Estagio ADD CONSTRAINT FK_Estagio_2
    FOREIGN KEY (fk_Aluno_matriculaAluno)
    REFERENCES Aluno (matriculaAluno)
    ON DELETE RESTRICT;
 
ALTER TABLE Estagio ADD CONSTRAINT FK_Estagio_3
    FOREIGN KEY (fk_ProfOrientador_matriculaProf)
    REFERENCES ProfOrientador (matriculaProf)
    ON DELETE RESTRICT;
 
ALTER TABLE Estagio ADD CONSTRAINT FK_Estagio_4
    FOREIGN KEY (fk_CoordEstag_matriculaCoord)
    REFERENCES CoordEstag (matriculaCoord)
    ON DELETE RESTRICT;
 
ALTER TABLE Notificacao ADD CONSTRAINT FK_Notificacao_2
    FOREIGN KEY (fk_Aluno_matriculaAluno)
    REFERENCES Aluno (matriculaAluno)
    ON DELETE RESTRICT;
 
ALTER TABLE Assina ADD CONSTRAINT FK_Assina_1
    FOREIGN KEY (fk_Documentacao_idDoc)
    REFERENCES Documentacao (idDoc)
    ON DELETE RESTRICT;
 
ALTER TABLE Assina ADD CONSTRAINT FK_Assina_2
    FOREIGN KEY (fk_Signatario_idSign)
    REFERENCES Signatario (idSign)
    ON DELETE RESTRICT;

CREATE INDEX idx_fk_Aluno_matriculaAluno ON Documentacao (fk_Aluno_matriculaAluno);

CREATE INDEX idx_fk_Aluno_matriculaAluno ON Frequencia (fk_Aluno_matriculaAluno);

CREATE INDEX idx_fk_Aluno_matriculaAluno ON Estagio (fk_Aluno_matriculaAluno);
CREATE INDEX idx_fk_ProfOrientador_matriculaProf ON Estagio (fk_ProfOrientador_matriculaProf);
CREATE INDEX idx_fk_CoordEstag_matriculaCoord ON Estagio (fk_CoordEstag_matriculaCoord);

CREATE INDEX idx_fk_Aluno_matriculaAluno ON Notificacao (fk_Aluno_matriculaAluno);

CREATE INDEX idx_fk_Documentacao_idDoc ON Assina (fk_Documentacao_idDoc);
CREATE INDEX idx_fk_Signatario_idSign ON Assina (fk_Signatario_idSign);
