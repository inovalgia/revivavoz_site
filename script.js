// Seleciona todos os links de navegação
const navLinks = document.querySelectorAll('.nav-link');
const dynamicFrame = document.getElementById('dynamic-frame');
const body = document.body;  // Seleciona o corpo da página para aplicar a opacidade
const backgroundOverlay = document.createElement('div'); // Cria um overlay para o fundo

// Conteúdos que serão exibidos ao clicar nos links
const contentData = {
    'sobre-nos':'Somos uma equipe apaixonada por música, cultura e impacto social. Nosso objetivo é reviver a essência do rock nacional, celebrando as grandes lendas e abrindo espaço para que novos talentos mostrem sua arte ao mundo. Acreditamos que a música tem o poder de unir pessoas, promover mudanças e despertar sentimentos únicos, e é por isso que criamos o Reviva Voz.',
    'Regulamento': 'Ao utilizar nossos serviços, é essencial respeitar os direitos de todos os clientes e garantir que o uso seja feito de forma ética e responsável. Práticas de assédio ou discriminação de qualquer tipo não serão toleradas. O cliente é responsável pelas informações fornecidas à empresa e deve seguir as políticas de privacidade e segurança estabelecidas. O não cumprimento dessas regras pode resultar na suspensão do serviço.',
    'informaçoes-adicionais': 'O festival acontecerá no Estádio Rockcenter, um dos maiores espaços de música da cidade, com estrutura moderna, estacionamento amplo, praça de alimentação variada e vista para o palco principal. O endereço é Av. das Nações, 1500 - Centro Rock, Cidade do Rock, SP. Para mais informações, entre em contato pelo e-mail info@revivavoz.com.br ou pelo telefone (11) 4002-8922. Fique atento às nossas redes sociais e site para atualizações. O evento abre às 10:00 AM, os shows começam às 12:00 PM e o encerramento é às 11:00 PM. Esperamos você para reviver os maiores hits do rock nacional!'
};

// Adiciona um evento de clique para cada link
navLinks.forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault(); // Impede o comportamento padrão do link
        
        // Obtém o ID da seção que deve ser exibida
        const frameId = link.getAttribute('data-frame');

        // Cria o elemento de conteúdo que será exibido
        const contentElement = document.createElement('div');
        contentElement.classList.add('content-frame', 'active');
        contentElement.innerText = contentData[frameId] || 'Conteúdo não encontrado.';

        // Cria o botão de voltar
        const backButton = document.createElement('button');
        backButton.classList.add('back-to-home');
        backButton.innerText = 'Voltar à Tela Inicial';

        // Evento de clique para voltar à tela inicial
        backButton.addEventListener('click', function() {
            // Oculta o frame e volta à tela inicial
            dynamicFrame.style.display = 'none'; // Esconde o frame
            backgroundOverlay.style.display = 'none'; // Esconde o fundo opaco
        });

        // Limpa o conteúdo anterior e adiciona o novo
        dynamicFrame.innerHTML = ''; // Limpa o conteúdo anterior
        dynamicFrame.appendChild(contentElement); // Adiciona o novo conteúdo
        dynamicFrame.appendChild(backButton); // Adiciona o botão de voltar

        // Adiciona o fundo opaco (overlay) à tela
        backgroundOverlay.style.position = 'fixed';
        backgroundOverlay.style.top = '0';
        backgroundOverlay.style.left = '0';
        backgroundOverlay.style.width = '100%';
        backgroundOverlay.style.height = '100%';
        backgroundOverlay.style.backgroundColor = 'rgba(0, 0, 0, 0.9)';
        backgroundOverlay.style.zIndex = '999'; // Coloca o fundo opaco atrás do conteúdo
        backgroundOverlay.style.display = 'block'; // Torna o fundo opaco visível
        document.body.appendChild(backgroundOverlay); // Adiciona o overlay ao corpo da página

        // Exibe o frame com animação suave
        dynamicFrame.style.display = 'block';
    });
});
