package core

type TopNewsError struct {
	IsTopNewsError bool
	Sdk              string
	Code             string
	Msg              string
	Ctx              *Context
	Result           any
	Spec             any
}

func NewTopNewsError(code string, msg string, ctx *Context) *TopNewsError {
	return &TopNewsError{
		IsTopNewsError: true,
		Sdk:              "TopNews",
		Code:             code,
		Msg:              msg,
		Ctx:              ctx,
	}
}

func (e *TopNewsError) Error() string {
	return e.Msg
}
