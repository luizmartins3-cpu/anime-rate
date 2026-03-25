/**
 * ESTUDO GUIADO: Manipulação de DOM e Eventos com JavaScript Puro
 * Este script controla as interações do site Anime Rate.
 */

// 1. Aguarda o carregamento completo do DOM antes de executar o script
document.addEventListener('DOMContentLoaded', () => {
    
    // 2. Seleção de elementos do DOM
    // Buscamos o formulário e a div de mensagem pelos seus IDs
    const formAvaliacao = document.getElementById('form-avaliacao');
    const mensagemSucesso = document.getElementById('mensagem-sucesso');

    /**
     * 3. Manipulação do Evento de Submissão (Submit)
     * Adicionamos um "ouvinte" para quando o usuário clicar no botão de enviar.
     */
    if (formAvaliacao) {
        formAvaliacao.addEventListener('submit', (event) => {
            // Impede o comportamento padrão de recarregar a página ao enviar o formulário
            event.preventDefault();

            // 4. Coleta de dados dos campos
            // Utilizamos o objeto FormData para capturar todos os valores de uma vez
            const formData = new FormData(formAvaliacao);
            const dados = {
                anime: formData.get('anime'),
                email: formData.get('email'),
                nota: formData.get('nota'),
                comentario: formData.get('comentario')
            };

            // 5. Simulação de processamento
            console.log('Dados da avaliação recebidos:', dados);

            // 6. Feedback visual para o usuário
            // Escondemos o formulário e mostramos a mensagem de sucesso
            formAvaliacao.style.display = 'none';
            mensagemSucesso.classList.remove('hidden');

            // Exibe um alerta simples de confirmação
            alert(`Obrigado! Sua avaliação para "${dados.anime}" foi enviada com sucesso.`);
        });
    }

    /**
     * 7. Interação Extra: Efeito de rolagem suave (Smooth Scroll)
     * Para todos os links internos da navegação
     */
    const linksNav = document.querySelectorAll('nav a');
    linksNav.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80, // Ajuste para o cabeçalho fixo
                    behavior: 'smooth'
                });
            }
        });
    });

});
