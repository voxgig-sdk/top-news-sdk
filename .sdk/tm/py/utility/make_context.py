# TopNews SDK utility: make_context

from core.context import TopNewsContext


def make_context_util(ctxmap, basectx):
    return TopNewsContext(ctxmap, basectx)
