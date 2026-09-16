# TopNews SDK feature factory

require_relative 'feature/base_feature'
require_relative 'feature/ratelimit_feature'
require_relative 'feature/retry_feature'
require_relative 'feature/test_feature'
require_relative 'feature/timeout_feature'


module TopNewsFeatures
  def self.make_feature(name)
    case name
    when "base"
      TopNewsBaseFeature.new
    when "ratelimit"
      TopNewsRatelimitFeature.new
    when "retry"
      TopNewsRetryFeature.new
    when "test"
      TopNewsTestFeature.new
    when "timeout"
      TopNewsTimeoutFeature.new
    else
      TopNewsBaseFeature.new
    end
  end
end
