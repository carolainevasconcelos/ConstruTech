create database if not exists ConstruTech;

use ConstruTech;

-- 1
CREATE TABLE  if not exists Projeto (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,        
    nome VARCHAR(255) NOT NULL,               
    descricao TEXT,                           
    data_inicio DATE,                         
    data_termino DATE,                        
    statu ENUM('ativo', 'inativo') NOT NULL 
)engine = InnoDB;

-- 4
ALTER TABLE Projeto
ADD cliente_id INT,
ADD CONSTRAINT fk_projeto_cliente FOREIGN KEY (cliente_id) REFERENCES Cliente(id);

-- 2
CREATE TABLE  if not exists Cliente (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,      
    nome VARCHAR(255) NOT NULL,            
    nome_fantasia VARCHAR(255),            
    cpf VARCHAR(11),                        
    cnpj VARCHAR(14), 
	senha VARCHAR(255) NOT NULL,                      
    endereco VARCHAR(255),                  
    telefone VARCHAR(20),                   
    email VARCHAR(255) NOT NULL                      
)engine = InnoDB;

-- 9
ALTER TABLE Cliente
ADD financeiro_id INT,
ADD documento_id INT,
ADD CONSTRAINT fk_cliente_financeiro FOREIGN KEY (financeiro_id) REFERENCES Financeiro(id),
ADD CONSTRAINT fk_cliente_documento FOREIGN KEY (documento_id) REFERENCES Documentos(id);

-- 3
CREATE TABLE IF NOT EXISTS Funcionario (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(18) NOT NULL,
	senha VARCHAR(255) NOT NULL,	
    telefone VARCHAR(25),
    endereco VARCHAR(100),
    email VARCHAR(100),
    data_admissão DATE,
    cargo VARCHAR(30),
    setor VARCHAR(50) NOT NULL,
    projeto_id INT,
    FOREIGN KEY (projeto_id) REFERENCES Projeto(id)    
) ENGINE = InnoDB;

-- 6
ALTER TABLE Funcionario
ADD atividade_id INT,
ADD CONSTRAINT fk_funcionario_atividade FOREIGN KEY (atividade_id) REFERENCES Atividade(id);

-- 5
CREATE TABLE Atividade (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,                          
    nome_atividade VARCHAR(255) NOT NULL,                       
    descricao TEXT,                                             
    data_inicio DATE NOT NULL,                                  
    data_termino DATE NOT NULL,                                 
    status ENUM('pendente', 'em andamento', 'concluido') NOT NULL, 
    responsavel_legal VARCHAR(255) NOT NULL,
    projeto_id int,
    foreign key (projeto_id) references projeto(id)
)engine = InnoDB;

-- 7
CREATE TABLE Documentos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,                      
    tipo_documento VARCHAR(255) NOT NULL,                  
    descricao TEXT,                                         
    data_geracao DATE,                            
    data_emissao DATE,                                                         
    arquivo BLOB NOT NULL,  
    projeto_id int,
    foreign key (projeto_id) references projeto(id)
)engine = InnoDB;	

-- 8
CREATE TABLE Financeiro (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,                        
    tipo_transacao ENUM('receita', 'despesas') NOT NULL,      
    valor DECIMAL(10, 2) NOT NULL,                             
    data DATE NOT NULL,                                       
    descricao TEXT,
    projeto_id int,
    foreign key (projeto_id) references projeto(id)
)engine = InnoDB;

-- 10
CREATE TABLE  if not exists Fornecedor (
    id INT AUTO_INCREMENT PRIMARY KEY,      
    nome VARCHAR(255) NOT NULL,            
    nome_fantasia VARCHAR(255),             
    cnpj VARCHAR(14) NOT NULL,              
    telefone VARCHAR(20),                   
    endereco VARCHAR(255),                 
    email VARCHAR(255) NOT NULL,
    financeiro_id int,
    foreign key (financeiro_id) REFERENCES financeiro(id)
)engine = InnoDB;

-- 11
CREATE TABLE  if not exists Estoque (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,          
    produto VARCHAR(255) NOT NULL,                
    quantidade_total INT NOT NULL,                
    tipo_movimentacao ENUM('entrada', 'saida') NOT NULL, 
    data_movimentacao DATE NOT NULL,
    financeiro_id int,
    projeto_id int, 
    foreign key (financeiro_id) references financeiro(id),
    foreign key (projeto_id) references projeto(id)
)engine = InnoDB;

-- 12
CREATE TABLE if not exists Equipamento (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,      
    tipo VARCHAR(255) NOT NULL,            
    descricao TEXT,                         
    quantidade INT NOT NULL,
    projeto_id INT,                                
    funcionario_id INT,                            
    fornecedor_id INT,                             
    FOREIGN KEY (projeto_id) REFERENCES projeto(id),   
    FOREIGN KEY (funcionario_id) REFERENCES funcionario(id), 
    FOREIGN KEY (fornecedor_id) REFERENCES fornecedor(id)
)engine = InnoDB;