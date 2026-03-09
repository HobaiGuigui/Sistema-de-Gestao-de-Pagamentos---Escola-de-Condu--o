# Escola de Conducao 3 de Agosto - Sistema de Gestao de Pagamentos

Este e um sistema web moderno e minimalista desenvolvido para gerir estudantes, categorias de cursos e pagamentos de uma escola de conducao.

## Tecnologias Utilizadas

- **Backend:** PHP 7+ (Arquitetura MVC customizada)
- **Base de Dados:** MySQL
- **Frontend:** HTML5, CSS3 (Minimalista), Bootstrap, FontAwesome
- **Graficos:** Chart.js
- **Tabelas:** DataTables.js

## Requisitos e Instalacao

1. **Servidor Web:** Recomenda-se XAMPP, WAMP ou Servidor Apache com PHP.
2. **Base de Dados:**
   - Crie uma base de dados chamada `escola_conducao_3agosto`.
   - Importe o ficheiro `database.sql` incluido na raiz do projeto.
3. **Configuracao:**
   - O ficheiro de ligacao a base de dados encontra-se em `app/Core/Database.php`. Ajuste as credenciais (host, user, pass) se necessario.
4. **Execucao:**
   - Aponte o servidor web para a pasta `public/`.
   - Para rodar com o servidor embutido do PHP (a partir da raiz do projeto), use:
     ```bash
     php -S localhost:8081 -t public public/router.php
     ```
   - Se aparecer a pagina do XAMPP em vez da aplicacao, a porta em uso nao e a da app.
     Neste caso, troque a porta (ex.: `8081`) ou pare o Apache do XAMPP.

## Acesso ao Sistema

- **Url:** `http://localhost:8081`
- **Utilizador:** `nick@escola3agosto.com`
- **Password:** `admin123`

## Principais Funcionalidades

- **Dashboard:** Visao geral de estatisticas e graficos financeiros.
- **Categorias de Cursos:** Gestao de precos e duracoes de cada categoria (A, B, C, D).
- **Gestao de Estudantes:** Cadastro completo e visualizacao de perfil financeiro.
- **Pagamentos:** Registo de pagamentos em parcelas com abatimento automatico no saldo.
- **Fatura A4:** Geracao automatica de fatura em duplicado (Via Estudante / Via Escola) formatada para impressao.
- **Relatorios:** Exportacao de historico de pagamentos para CSV e visualizacao web.

---

**Desenvolvido por [Hiobaldine Sá](https://www.linkedin.com/in/hiobaldine/) © 2026**
