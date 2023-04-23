import tippy, { createSingleton } from 'tippy.js'

export default class TippyWrapper {
    constructor() {
        this.detectTippyButtons()
    }

    detectTippyButtons() {
        this.detectSingletonTooltips()
    }

    detectSingletonTooltips() {
        const singletonTooltips = document.querySelectorAll('[data-tippy-singleton]')

        createSingleton(
            Array.from(singletonTooltips).map(tooltip => this.createTippyInstance(tooltip)),
            {
                moveTransition: 'transform 0.2s ease-out',
                theme: 'translucent',
                allowHTML: true
            }
        )
    }

    createTippyInstance(element) {
        const content = element.dataset['tippyContent'],
            placement = element.dataset['tippyPlacement'],
            interactive = element.dataset['tippyInteractive']

        return tippy(element, {
            content,
            interactive: interactive !== undefined,
            placement,
            allowHTML: true,
            theme: 'translucent',
        })
    }
}