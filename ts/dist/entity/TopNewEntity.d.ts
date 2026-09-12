import { TopNewsEntityBase } from '../TopNewsEntityBase';
import type { TopNewsSDK } from '../TopNewsSDK';
import type { Control } from '../types';
import type { TopNew, TopNewListMatch } from '../TopNewsTypes';
declare class TopNewEntity extends TopNewsEntityBase<TopNew> {
    constructor(client: TopNewsSDK, entopts: any);
    make(this: TopNewEntity): TopNewEntity;
    list(this: any, reqmatch?: TopNewListMatch, ctrl?: Control): Promise<TopNewEntity[]>;
}
export { TopNewEntity };
