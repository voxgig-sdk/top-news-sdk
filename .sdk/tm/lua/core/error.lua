-- TopNews SDK error

local TopNewsError = {}
TopNewsError.__index = TopNewsError


function TopNewsError.new(code, msg, ctx)
  local self = setmetatable({}, TopNewsError)
  self.is_sdk_error = true
  self.sdk = "TopNews"
  self.code = code or ""
  self.msg = msg or ""
  self.ctx = ctx
  self.result = nil
  self.spec = nil
  return self
end


function TopNewsError:error()
  return self.msg
end


function TopNewsError:__tostring()
  return self.msg
end


return TopNewsError
