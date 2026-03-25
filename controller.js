/**
 * INTEGRAÇÃO (controller.js)
 * Orquestração entre a interface HTML e o mini-framework de banco de dados.
 */

/**
 * Função para atualizar a tela com os dados do banco.
 */
async function carregarAvaliacoes() {
    try {
        const itens = await buscarItens(); // Função global de db.js
        const listaContainer = document.getElementById('avaliacoes-salvas');
        
        if (!listaContainer) return;

        // Limpa o container e renderiza os itens
        listaContainer.innerHTML = '<h3>Avaliações Salvas (Local)</h3>';
        
        if (itens.length === 0) {
            listaContainer.innerHTML += '<p>Nenhuma avaliação salva no banco de dados ainda.</p>';
            return;
        }

        itens.forEach(item => {
            const div = document.createElement('div');
            div.style.border = '1px solid #ff2e63';
            div.style.padding = '10px';
            div.style.margin = '10px 0';
            div.style.borderRadius = '5px';
            div.style.backgroundColor = '#1a1e26';

            div.innerHTML = `
                <p><strong>Anime:</strong> ${item.anime}</p>
                <p><strong>Nota:</strong> ${item.nota}/10</p>
                <p><strong>Comentário:</strong> ${item.comentario}</p>
                <button onclick="handleDeletar(${item.id})" style="background-color: #ff2e63; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px;">Excluir</button>
            `;
            listaContainer.appendChild(div);
        });
    } catch (erro) {
        console.error('Erro ao carregar avaliações:', erro);
    }
}

/**
 * Função global para lidar com a exclusão (chamada pelo onclick no HTML gerado)
 */
async function handleDeletar(id) {
    if (confirm('Deseja excluir esta avaliação?')) {
        try {
            await deletarItem(id); // Função global de db.js
            carregarAvaliacoes(); // Atualiza a tela
        } catch (erro) {
            alert('Erro ao deletar item.');
        }
    }
}

/**
 * Captura o evento de submit do formulário existente
 */
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-avaliacao');

    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Pega os dados dos inputs
            const animeInput = document.getElementById('anime');
            const emailInput = document.getElementById('email');
            const notaInput = document.getElementById('nota');
            const comentarioInput = document.getElementById('comentario');

            // Cria objeto com esses dados
            const novoDado = {
                anime: animeInput.value,
                email: emailInput.value,
                nota: notaInput.value,
                comentario: comentarioInput.value,
                data: new Date().toLocaleDateString()
            };

            try {
                // Envia para a função adicionarItem() do db.js
                await adicionarItem(novoDado);
                
                // Limpa o formulário
                form.reset();
                
                // Mostra os dados salvos na tela dinamicamente
                carregarAvaliacoes();
                
                alert('Avaliação salva com sucesso no IndexedDB!');
            } catch (erro) {
                console.error('Erro ao salvar:', erro);
                alert('Erro ao salvar no banco de dados.');
            }
        });
    }

    // Carrega os itens já existentes ao abrir a página
    carregarAvaliacoes();
});
