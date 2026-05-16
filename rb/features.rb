# TopNews SDK feature factory

require_relative 'feature/base_feature'
require_relative 'feature/test_feature'


module TopNewsFeatures
  def self.make_feature(name)
    case name
    when "base"
      TopNewsBaseFeature.new
    when "test"
      TopNewsTestFeature.new
    else
      TopNewsBaseFeature.new
    end
  end
end
