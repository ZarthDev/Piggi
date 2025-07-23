document.addEventListener("DOMContentLoaded", function () {
  let cards = document.getElementsByClassName('bancoImage');

  let bancoImages = {
    'itau': 'https://logo.clearbit.com/itau.com.br',
    'bradesco': 'https://logo.clearbit.com/bradesco.com.br',
    'santander': 'https://logo.clearbit.com/santander.com.br',
    'caixa': 'https://logo.clearbit.com/caixa.gov.br',
    'banco do brasil': 'https://logo.clearbit.com/bancodobrasil.com.br',
    'nubank': 'https://logo.clearbit.com/nubank.com.br',
    'inter': 'https://logo.clearbit.com/inter.com.br',
    'original': 'https://logo.clearbit.com/original.com.br',
    'sicoob': 'https://logo.clearbit.com/sicoob.com.br',
    'sicredi': 'https://logo.clearbit.com/sicredi.com.br',
    'banrisul': 'https://logo.clearbit.com/banrisul.com.br',
    'banco pan': 'https://logo.clearbit.com/bancopan.com.br',
    'banco do nordeste': 'https://logo.clearbit.com/bnb.gov.br',
    'banco da amazonia': 'https://logo.clearbit.com/bancoamazonia.com.br',
    'c6 bank': 'https://logo.clearbit.com/c6bank.com.br',
    'pagbank': 'https://logo.clearbit.com/pagseguro.uol.com.br',
    'picpay': 'https://logo.clearbit.com/picpay.com.br',
    'mercado pago': 'https://logo.clearbit.com/mercadopago.com.br',
    'neo': 'https://logo.clearbit.com/neo.com.br'
  };

  for (let i = 0; i < cards.length; i++) {
    let card = cards[i];
    let classListArr = Array.from(card.classList);
    let bancoClass = classListArr.find(c => c.startsWith('@'));

    if (bancoClass) {
      let bancoNome = bancoClass.substring(1).toLowerCase().trim();
      card.setAttribute('src', bancoImages[bancoNome] || 'https://logo.clearbit.com/default.com');
    } else {
      card.setAttribute('src', 'https://logo.clearbit.com/default.com');
    }

    card.setAttribute('alt', 'Logo do banco');
    card.style.width = '30px';
    card.style.height = '30px';
    card.style.borderRadius = '50%';
    card.style.marginLeft = '10px';
  }
});
