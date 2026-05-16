# TopNews SDK utility: feature_add
module TopNewsUtilities
  FeatureAdd = ->(ctx, f) {
    ctx.client.features << f
  }
end
