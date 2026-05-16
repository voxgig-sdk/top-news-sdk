
import { Context } from './Context'


class TopNewsError extends Error {

  isTopNewsError = true

  sdk = 'TopNews'

  code: string
  ctx: Context

  constructor(code: string, msg: string, ctx: Context) {
    super(msg)
    this.code = code
    this.ctx = ctx
  }

}

export {
  TopNewsError
}

