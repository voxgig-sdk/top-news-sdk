# TopNews SDK utility: make_context
require_relative '../core/context'
module TopNewsUtilities
  MakeContext = ->(ctxmap, basectx) {
    TopNewsContext.new(ctxmap, basectx)
  }
end
