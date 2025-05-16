# Montink ERP

Sistema ERP desenvolvido em PHP com arquitetura MVC.

## Estrutura do Projeto

```
montink/
├── app/                    # Diretório principal da aplicação
│   ├── components/        # Componentes reutilizáveis
│   ├── controllers/       # Controladores da aplicação
│   ├── models/           # Modelos de dados
│   ├── services/         # Serviços e lógica de negócio
│   └── views/            # Templates e views
├── assets/               # Recursos estáticos
├── config/              # Arquivos de configuração
├── includes/            # Componentes PHP reutilizáveis
├── public/              # Diretório público
│   ├── css/            # Arquivos CSS
│   ├── images/         # Imagens
│   ├── js/             # Arquivos JavaScript
│   └── index.php       # Ponto de entrada da aplicação
├── database.sql         # Script de criação do banco de dados
└── index.php           # Arquivo principal
```

## Requisitos

- PHP 8.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache/Nginx)
- Composer (para gerenciamento de dependências)

## Configuração

1. Clone o repositório
2. Configure o banco de dados:
   - Importe o arquivo `database.sql` no seu servidor MySQL
   - Configure as credenciais em `config/database.php`
3. Configure o servidor web:
   - Aponte o DocumentRoot para o diretório `public/`
   - Certifique-se que o mod_rewrite está habilitado (Apache)
4. Inicie seu servidor web local
5. Acesse o projeto através do navegador

## Desenvolvimento

### Estrutura MVC

- **Models**: Localizados em `app/models/`, contêm a lógica de acesso aos dados
- **Views**: Localizados em `app/views/`, contêm os templates e apresentação
- **Controllers**: Localizados em `app/controllers/`, gerenciam as requisições
- **Services**: Localizados em `app/services/`, contêm a lógica de negócio

### Recursos Estáticos

- CSS: `public/css/`
- JavaScript: `public/js/`
- Imagens: `public/images/`

### Componentes

- Componentes reutilizáveis: `app/components/`
- Includes PHP: `includes/`

## Tecnologias Utilizadas

- PHP 8.4.6
- MySQL 5.7+
- HTML5
- CSS3
- JavaScript

## Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova feature'`)
4. Push para a branch (`git push origin feature/nova-feature`)
5. Abra um Pull Request
