/** Design 12 only: a native, keyboard-operable photography selector. */
export function renderSessionPicker({ services, img, esc, live }) {
  const invitations = {
    pets: 'Plan a pet session',
    portraits: 'Plan a portrait session',
    family: 'Plan a family session',
    homes: 'Let’s photograph your property',
    events: 'Tell us about your event',
    landscapes: 'Let’s talk landscapes',
  };
  const prompts = {
    pets: 'Their favorite place, their favorite person, and a little room to play.',
    portraits: 'A graduation, a milestone, or simply a photograph that feels like you.',
    family: 'Bring your people. We’ll start with what makes this season yours.',
    homes: 'Show the light, the space, and the details that make a place feel like home.',
    events: 'Tell us what’s happening, who’s coming, and what you want to remember.',
    landscapes: 'A favorite view, a meaningful location, or a place you’d love to explore.',
  };
  return `<!-- Future WordPress part: template-parts/page-work/content-work-contact.php -->
  <section class="contact-section session-picker" id="contact" aria-labelledby="session-heading">
    <div class="shell session-inner">
      <div class="session-heading"><div><p class="session-eyebrow">Your next chapter</p><h2 id="session-heading">Contact Us</h2></div><p>A familiar face. A favorite place. A moment worth keeping. Choose a collection and let’s start there.</p></div>
      <div class="session-layout">
        <fieldset class="session-choices"><legend>What are we photographing?</legend>${services.map((category, index) => `
          <label class="session-choice" for="session-${category.id}"><input type="radio" id="session-${category.id}" name="photography-session" value="${category.id}" aria-controls="session-preview-${category.id}"${index === 0 ? ' checked' : ''}><span class="session-number" aria-hidden="true">0${index + 1}</span><span class="session-name">${esc(category.name)}</span><span class="session-arrow" aria-hidden="true">↗</span></label>`).join('')}
        </fieldset>
        <div class="session-previews">${services.map(category => `
          <article class="session-panel" id="session-preview-${category.id}" aria-labelledby="session-title-${category.id}"><figure class="session-image">${img(category.id, { small: true })}<figcaption>${esc(category.name)}</figcaption></figure><div class="session-details"><h3 id="session-title-${category.id}">${esc(category.title)}</h3><p>${esc(prompts[category.id])}</p><p class="session-scope">${esc(category.scope)}</p><div class="session-actions"><a class="button" href="${live}/contact/?category=${category.id}">${esc(invitations[category.id])}<span aria-hidden="true">↗</span></a><a class="session-back" href="#${category.id}">Explore the collection <span aria-hidden="true">↑</span></a></div></div></article>`).join('')}
        </div>
      </div>
    </div>
  </section>`;
}
