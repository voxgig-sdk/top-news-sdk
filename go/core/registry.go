package core

var UtilityRegistrar func(u *Utility)

var NewBaseFeatureFunc func() Feature

var NewTestFeatureFunc func() Feature

var NewTopNewEntityFunc func(client *TopNewsSDK, entopts map[string]any) TopNewsEntity

