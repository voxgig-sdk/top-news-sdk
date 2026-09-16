# TopNews SDK feature factory

from topnews_sdk.feature.base_feature import TopNewsBaseFeature
from topnews_sdk.feature.ratelimit_feature import TopNewsRatelimitFeature
from topnews_sdk.feature.retry_feature import TopNewsRetryFeature
from topnews_sdk.feature.test_feature import TopNewsTestFeature
from topnews_sdk.feature.timeout_feature import TopNewsTimeoutFeature


_FEATURES = {
    "base": lambda: TopNewsBaseFeature(),
    "ratelimit": lambda: TopNewsRatelimitFeature(),
    "retry": lambda: TopNewsRetryFeature(),
    "test": lambda: TopNewsTestFeature(),
    "timeout": lambda: TopNewsTimeoutFeature(),
}


def _make_feature(name):
    factory = _FEATURES.get(name)
    if factory is not None:
        return factory()
    return _FEATURES["base"]()


# True when this SDK was generated with the named feature class - the
# constructor's tolerance for extend-carried features reads this (an
# active name with no generated class must not become a BaseFeature
# stray when an extend instance carries it).
def _has_feature(name):
    return name in _FEATURES
