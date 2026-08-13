# TopNews SDK feature factory

from topnews_sdk.feature.base_feature import TopNewsBaseFeature
from topnews_sdk.feature.test_feature import TopNewsTestFeature


def _make_feature(name):
    features = {
        "base": lambda: TopNewsBaseFeature(),
        "test": lambda: TopNewsTestFeature(),
    }
    factory = features.get(name)
    if factory is not None:
        return factory()
    return features["base"]()
