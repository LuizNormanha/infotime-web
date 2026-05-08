import {getRequestConfig} from 'next-intl/server'

export default getRequestConfig(async ({locale}) => {
  const idioma = locale === 'pt-BR' ? 'pt-BR' : 'pt-BR'

  return {
    locale: idioma,
    messages: (await import(`./mensagens/${idioma}.json`)).default,
  }
})

