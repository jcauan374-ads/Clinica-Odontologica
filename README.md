<div align="center">

# 🦷 Clínica Odontológica

### Sistema web de gestão e agendamento de consultas

[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)](https://developer.mozilla.org/pt-BR/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)](https://developer.mozilla.org/pt-BR/docs/Web/CSS)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Status](https://img.shields.io/badge/Status-Projeto_concluído-beef00?style=for-the-badge&logoColor=black)](#status-do-projeto)

> **Plataforma responsiva para apresentar serviços odontológicos e centralizar o agendamento de consultas.**

</div>

---

## 🧭 Sobre o projeto

A **Clínica Odontológica** é um sistema web desenvolvido para modernizar o atendimento de uma clínica, reunindo informações sobre serviços, apresentação institucional e agendamento de consultas em uma experiência simples e responsiva.

O projeto combina uma interface construída com HTML e CSS, processamento de formulários em PHP e persistência de dados em MySQL.

<div align="center">

| 🦷 Domínio | 🧰 Stack | 📱 Experiência |
|:---:|:---:|:---:|
| Odontologia | PHP + MySQL | Responsiva |

</div>

---

## ✨ Funcionalidades

| Recurso | Descrição | Situação |
|---|---|:---:|
| 🦷 Serviços | Apresentação de procedimentos e especialidades oferecidas. | ✅ |
| 📅 Agendamento | Formulário para solicitação de consultas online. | ✅ |
| 📝 Processamento | Recebimento e tratamento dos dados enviados pelo usuário. | ✅ |
| 🗄️ Banco de dados | Integração do formulário com uma base MySQL. | ✅ |
| 📱 Responsividade | Interface adaptada para desktop e dispositivos móveis. | ✅ |
| 🏥 Institucional | Página sobre a clínica e sua proposta de atendimento. | ✅ |

---

## 🗂️ Estrutura do projeto

```text
Clinica-Odontologica/
├── index.html       # Página inicial
├── servicos.html    # Serviços odontológicos
├── sobre.html       # Informações sobre a clínica
├── agendar.php      # Formulário e processamento do agendamento
├── style.css        # Estilos e responsividade
├── banco.sql        # Estrutura do banco de dados
└── README.md        # Documentação do projeto
```

---

## 🛠️ Tecnologias utilizadas

<div align="center">

![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)

</div>

- **HTML5:** estrutura das páginas e conteúdo semântico.
- **CSS3:** identidade visual, layout, componentes e adaptação para telas menores.
- **PHP:** processamento do formulário de agendamento.
- **MySQL:** armazenamento das informações enviadas pela aplicação.

---

## ⚙️ Como executar localmente

### Pré-requisitos

Instale um ambiente com PHP e MySQL, como **XAMPP**, **WampServer** ou uma instalação equivalente.

### Passo a passo

```bash
git clone https://github.com/jcauan374-ads/Clinica-Odontologica.git
cd Clinica-Odontologica
```

1. Crie um banco de dados MySQL.
2. Execute o arquivo [`banco.sql`](./banco.sql) para criar a estrutura necessária.
3. Configure as credenciais do banco no arquivo `agendar.php`, se necessário.
4. Coloque o projeto na pasta pública do seu servidor local.
5. Inicie Apache e MySQL.
6. Acesse o endereço local do projeto pelo navegador.

Com o servidor embutido do PHP, a aplicação pode ser iniciada com:

```bash
php -S localhost:8000
```

Depois, abra `http://localhost:8000`.

> As credenciais de banco e os dados utilizados devem ser configurados apenas no ambiente local. Não publique senhas reais no repositório.

---

## 🧱 Conceitos aplicados

`HTML semântico` · `CSS responsivo` · `formulários web` · `PHP` · `CRUD inicial` · `MySQL` · `integração front-end e back-end` · `organização de páginas`

---

## 🚧 Status do projeto

Projeto acadêmico concluído em sua versão inicial. O sistema pode evoluir com autenticação, painel administrativo, validações avançadas, confirmação automática de consultas e melhorias de acessibilidade.

---

## 👨‍💻 Autor

**José Cauan Ferreira da Silva**  
Estudante de Análise e Desenvolvimento de Sistemas — UNICID  
[LinkedIn](https://www.linkedin.com/in/jos%C3%A9-cauan-8247922b0) · [GitHub](https://github.com/jcauan374-ads)

---

<div align="center">

### 🦷 Tecnologia a serviço de um atendimento melhor

**Uma boa experiência começa antes da consulta.**

[⬆️ Voltar ao início](#-clínica-odontológica)

</div>
